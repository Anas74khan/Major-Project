<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Variety;
use App\Models\Review;

class ProductController extends Controller
{
    
    protected $table = [
        'tableName' => 'products',
        'imagePath' => 'images/products/',
        'fieldDetails' => [
            'categories' => [
                'type'     => 'select',
                'name'     => 'categories',
                'label'    => 'Categories',
                'required' => true,
                'feedback' => "Atleast one category is required.",
                'multiple' => true,
                'relation' => 'categories'
            ],
            'subCategories' => [
                'type'     => 'select',
                'name'     => 'subCategories',
                'label'    => 'Sub categories',
                'required' => true,
                'feedback' => "Atleast one sub category is required.",
                'multiple' => true,
                'relation' => 'subCategories'
            ],
            'brand' => [
                'type'     => 'select',
                'name'     => 'brand',
                'label'    => 'Brand',
                'required' => true,
                'feedback' => "Brand is required.",
                'relation' => 'brands'
            ],
            'name' => [
                'type'     => 'text',
                'name'     => 'name',
                'label'    => 'Product name',
                'required' => true,
                'feedback' => "Product name is required."
            ],
            'description' => [
                'type'     => 'textarea',
                'name'     => 'description',
                'label'    => 'Description'
            ],
            'similar' => [
                'type'     => 'text',
                'name'     => 'similar',
                'label'    => 'Similar product'
            ]
        ]
    ];

    public function viewIndex(Request $request){
        $this -> table['actions'] = ['add' => true, 'edit' => true, 'delete' => false];
        $this -> table['listFields'] = ['categories','subCategories','brand','name','description'];
        $this -> table['addFields']  = ['categories','subCategories','brand','name','description'];
        $this -> table['editFields'] = ['categories','subCategories','description'];
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'products';
        $this -> table['url'] = url('products');
        $this -> table['extraActions'] = [
            [
                'link' => url('product/{id}'),
                'name' => 'Varieties',
                'class' => 'btn-primary',
                'icon' => 'mdi mdi-creation',
                'replace' => ['{id}' => 'id']
            ]
        ];
        $this -> table['breadcrumbs'] = [
            ['name' => "Products"]
        ];
        
        return view('pages.table', $this -> table);
    }
    
    public function index(){
        $products =  Product :: get(['id','categories','subCategories','brand','name','description','similar']);

        return [
            'success' => true,
            'products' => $products,
            'relations' => [
                'categories' => Tag :: orderBy('displayOrder','asc') -> where('visibility', 1) -> where('tagTypeId',1) -> get(['id','tag AS value']),
                'subCategories' => Tag :: orderBy('displayOrder','asc') -> where('visibility', 1) -> where('tagTypeId',2) -> get(['id','tagRefId','tag AS value']),
                'brands' => Tag :: orderBy('displayOrder','asc') -> where('visibility', 1) -> where('tagTypeId',3) -> get(['id','tagRefId','tag AS value']),
            ]
        ];
    }

    public function get($category = "all", $subcategory = "all" ,$brand = "all", $from = 0, $limit = 20, $order_by = 'rating'){

        $tags = Tag :: where('tagTypeId',1) -> get(['id','tag','slug']);
        $categories = [];
        for($i = 0; $i < count($tags); $i++){
            $categories[$tags[$i]['id']] = $tags[$i]['tag'];
            if($category != "all" && $category == $tags[$i]['slug'])
                $category = $tags[$i]['id'];
        }
            
        $tags = Tag :: where('tagTypeId',2) -> get(['id','tag','slug']);
        $subcategories = [];
        for($i = 0; $i < count($tags); $i++){
            $subcategories[$tags[$i]['id']] = $tags[$i]['tag'];
            if($subcategory != "all" && $subcategory == $tags[$i]['slug'])
                $subcategory = $tags[$i]['id'];
        }
        
        if($from > 0) $from -= 1;

        $products = Product :: leftJoin('tags AS brand','brand.id','=','products.brand') -> take($limit) -> skip($from);
        $products -> leftJoin('reviews','reviews.productId','=','products.id') -> groupBy(['products.id','products.categories','products.subcategories','brand.tag','products.name','products.description']);
        $products -> select(
            'products.id','products.categories','products.subcategories',
            'brand.tag AS brand','products.name','products.description',
            Product::raw('COALESCE(round(AVG(reviews.rating),2),0) AS rating'),
            Product::raw('COALESCE((SELECT count(varieties.id) FROM varieties
                            WHERE varieties.productId = products.id GROUP BY varieties.productId),0) AS varieties'),
            Product::raw('COALESCE((SELECT CASE WHEN varieties.offerEnable = 1 THEN varieties.offerPercentage
                            ELSE 0 END FROM varieties
                            WHERE varieties.productId = products.id
                            ORDER BY varieties.offerPercentage DESC LIMIT 1),0) AS offer_percent')
        );
        if($order_by == 'offer')
            $products -> orderBy('offer_percent','DESC');
        else
            $products -> orderBy('rating','DESC');
        $products -> havingRaw('varieties > 0');

        if($brand != "all")
            $products -> where('brand.slug',$brand);
        if($category != "all")
            $products -> whereJsonContains('products.categories',$category);
        if($subcategory != "all")
            $products -> whereJsonContains('products.subcategories',$subcategory);

        $products = $products -> get();

        for($i = 0; $i < count($products); $i++){
            $temp = json_decode($products[$i]['categories'],true);
            for($j = 0; $j < count($temp); $j++)
                $temp[$j] = $categories[$temp[$j]];
            $products[$i]['categories'] = $temp;
            
            $temp = json_decode($products[$i]['subcategories'],true);
            for($j = 0; $j < count($temp); $j++)
                $temp[$j] = $subcategories[$temp[$j]];
            $products[$i]['subcategories'] = $temp;

            $variety = Variety :: where('productId',$products[$i]['id']) -> where('visibility',1);

            if($order_by == 'offer'){
                $variety -> orderBy('offerEnable','DESC');
                $variety -> orderBy('offerPercentage','DESC');
            }

            $variety = $variety -> first();

            $products[$i]['varietyId'] = $variety['id'];
            $products[$i]['image'] = asset($this -> table['imagePath'].json_decode($variety['images'],true)[0]);
            $products[$i]['inStock'] = $variety['inStock'];
            $products[$i]['sellingPrice'] = $variety['sellingPrice'];
            $products[$i]['offerEnable'] = $variety['offerEnable'];
            $products[$i]['offerPrice'] = $variety['offerPrice'];
            $products[$i]['offerPercentage'] = $variety['offerPercentage'];
            $products[$i]['name'] .= ' | '.$variety['name'];

        }

        return ['success' => true, 'products' => $products];
    }

    public function product(Request $request, $id = 0){
        $product = Product :: join('varieties','varieties.productId','=','products.id')
                    -> where('varieties.id',$id) -> where('varieties.visibility',1)
                    -> first(['products.id','products.categories','products.subcategories','products.name','products.brand','products.description']);
        
        if(empty($product['id'])) return ['success' => false,'code' => 201,'text' => 'Product not found.'];

        $product['brand'] = Tag :: where('id',$product['brand']) -> first('tag');
        $product['brand'] = $product['brand']['tag'] ? $product['brand']['tag'] : 'Brand not found';
        
        $product['varieties'] = Variety :: where('visibility',1) -> where('productId',$product['id'])
                                    -> get(['varieties.id','varieties.name','varieties.id','varieties.images',
                                            'varieties.features','varieties.inStock','varieties.sellingPrice',
                                            'varieties.offerEnable','varieties.offerPrice','varieties.offerPercentage']);
        
        for($i = 0; $i < count($product['varieties']); $i++){
            $images = json_decode($product['varieties'][$i]['images'],true);

            for($j = 0; $j < count($images); $j++)
                $images[$j] = asset($this -> table['imagePath'].$images[$j]);

            $product['varieties'][$i]['images'] = $images;
        }


        return ['success' => true,'product' => $product, 'user' => $request -> user];
    }

    public function varieties(Request $request, $id = 0){
        $data = ['admin' => $request -> admin];
        $data['product'] = json_decode(json_encode(Product :: where('id', $id) -> first([
            'id','categories', 'subCategories', 'brand', 'name', 'description'
        ])),true);

        if(empty($data['product']['id']))
            return view('pages.404', $data);

        $data['varieties'] = Variety :: where('productId', $id) -> get([
            'id','name','images','features','inStock','sellingPrice','offerPercentage','offerEnable','offerPrice','visibility','tags'
        ]);

        for($i = 0; $i < count($data['varieties']); $i++){
            $images = json_decode($data['varieties'][$i]['images'],true);
            for($j = 0; $j < count($images); $j++)
                $images[$j] = asset($this -> table['imagePath'].$images[$j]);
            $data['varieties'][$i]['images'] = $images;
        }

        $data['breadcrumbs'] = [
            ['name' => "Products", 'url' => asset('product')],
            ['name' => $data['product']['name']]
        ];

        $data['product']['categories'] = json_decode($data['product']['categories'],true);
        $data['product']['subCategories'] = json_decode($data['product']['subCategories'],true);

        $tags = $data['product']['categories'];
        foreach($data['product']['subCategories'] as $tag)
            array_push($tags,$tag);
        array_push($tags,$data['product']['brand']);
        $tags = Tag :: whereIn('id',$tags) -> get(['id','tag']);

        for($i = 0; $i < count($data['product']['categories']); $i++){
            for($j = 0; $j < count($tags); $j++){
                if($tags[$j]['id'] == $data['product']['categories'][$i]){
                    $data['product']['categories'][$i] = $tags[$j]['tag'];
                    break;
                }
            }
        }

        for($i = 0; $i < count($data['product']['subCategories']); $i++){
            for($j = 0; $j < count($tags); $j++){
                if($tags[$j]['id'] == $data['product']['subCategories'][$i]){
                    $data['product']['subCategories'][$i] = $tags[$j]['tag'];
                    break;
                }
            }
        }

        for($j = 0; $j < count($tags); $j++){
            if($tags[$j]['id'] == $data['product']['brand']){
                $data['product']['brand'] = $tags[$j]['tag'];
                break;
            }
        }

        $ratings = Review :: select(Review :: raw('COUNT(id) AS ratings'),Review :: raw('COALESCE(CAST(AVG(rating) AS DECIMAL(10,2)),5) AS stars')) -> where('productId',$id) -> groupBy('productId') -> first();

        $data['ratings'] = 0;
        $data['stars'] = 5;
        if($ratings){
            $data['ratings'] = $ratings['ratings'];
            $data['stars'] = $ratings['stars'];
        }

        return view('pages.product', $data);
    }

    public function varietyEdit(Request $request, $id = 0){
        $result = ['success' => false];
        $variety = Variety :: where('id', $id) -> first();
        if(empty($variety['id']))
            $result['text'] = 'Invalid action: Slider does not exist.';
        else{
            $variety = [
                'name' => $request -> input('name'),
                'features' => $request -> input('features'),
                'offerPercentage' => $request -> input('offerPercentage'),
                'offerPrice' => (float)$request -> input('offerPrice'),
                'sellingPrice' => (float)$request -> input('sellingPrice'),
                'offerEnable' => $request -> input('offerEnable') ? 1 : 0,
                'images' => json_decode($variety['images'],true)
            ];

            $varietyImageCount = count($variety['images']);
            $images = $request -> file('images');
            $temp = [];
            if($images){
                for($i = 0; $i < count($images); $i++){
                    if($images[$i]){
                        $image = time().$i.'.'.$images[$i]->getClientOriginalExtension();
                        array_push($temp,$image);
                        $images[$i]->move(public_path($this -> table['imagePath']), $image);
                    }
                    else
                        array_push($temp,'');
                }
            }
            else $temp = [''];

            for($i = 0; $i < count($temp); $i++){
                if(empty($temp[$i]) && $i < $varietyImageCount)
                    $temp[$i] = $variety['images'][$i];
                else if($i < $varietyImageCount){
                    $image_path = $this -> table['imagePath'].'/'.$variety['images'][$i];
                    if(File::exists($image_path))
                        File::delete($image_path);
                }
            }

            $variety['images'] = json_encode($temp);
            
            if(strlen($variety['name']) < 4){
                $result['code'] = 151;
                $result['text'] = "Name error: variety should have a name.";
            }
            else if($variety['sellingPrice'] <= 0){
                $result['code'] = 152;
                $result['text'] = "Price error: variety should have a proper price.";
            }
            else if($variety['offerEnable'] && $variety['offerPrice'] <= 0 && $variety['sellingPrice'] <= $variety['offerPrice']){
                $result['code'] = 153;
                $result['text'] = "Price error: variety offer price is not correct.";
            }
            else{
                Variety :: where('id', $id) -> update($variety);
                $result = ['success' => true, 'text' => 'Data updated successfully.'];
            }
        }
        return $result;
    }

    public function varietyAdd(Request $request){
        $productId = $request -> input('productId');
        $product = Product :: where('id', $productId) -> first();

        $result = ['success' => false];
        if(empty($product['id']))
            $result['text'] = "Invalid request: Product does not exit.";
        else{
            $variety = [
                'name' => $request -> input('name'),
                'productId' => $request -> input('productId'),
                'features' => $request -> input('features'),
                'offerPercentage' => $request -> input('offerPercentage'),
                'offerPrice' => (float)$request -> input('offerPrice'),
                'sellingPrice' => (float)$request -> input('sellingPrice'),
                'offerEnable' => $request -> input('offerEnable') ? 1 : 0,
                'images' => [],
            ];

            $images = $request -> file('images');
            for($i = 0; $i < count($images); $i++){
                if($images[$i]){
                    $image = time().$i.'.'.$images[$i]->getClientOriginalExtension();
                    array_push($variety['images'],$image);
                    $images[$i]->move(public_path($this -> table['imagePath']), $image);
                }
            }

            if(count($variety['images']) == 0){
                $result['code'] = 150;
                $result['text'] = "Image error: please provide atleast one image.";
            }
            else if(strlen($variety['name']) < 4){
                $result['code'] = 151;
                $result['text'] = "Name error: variety should have a name.";
            }
            else if($variety['sellingPrice'] <= 0){
                $result['code'] = 152;
                $result['text'] = "Price error: variety should have a proper price.";
            }
            else if($variety['offerEnable'] && $variety['offerPrice'] <= 0 && $variety['sellingPrice'] <= $variety['offerPrice']){
                $result['code'] = 153;
                $result['text'] = "Price error: variety offer price is not correct.";
            }
            else{
                $variety['images'] = json_encode($variety['images']);
                Variety :: insert($variety);
                $result = ['success' => true, 'text' => 'Data updated successfully.'];
            }
        }

        return $result;
    }

    public function visibility(Request $request, $id = 0){
        $variety = Variety :: where('id', $id) -> first();

        $result = ['success' => false];
        if(empty($variety['id']))
            $result['text'] = "Invalid request: Variety does not exist.";
        else{
            $result['success'] = Variety :: where('id', $id) -> update(['visibility' => empty($request -> input('visibility')) ? 0 : 1]);
            if($result['success'])
                $result['text'] = "Visibility changed successfully.";
            else{
                $result['code'] = 155;
                $result['text'] = "Request error: Improper visbility.";
            }
        }
        return $result;
    }

    public function stock(Request $request, $id = 0){
        $variety = Variety :: where('id', $id) -> first();

        $result = ['success' => false];
        if(empty($variety['id']))
            $result['text'] = "Invalid request: Variety does not exist.";
        else{
            $result['success'] = Variety :: where('id', $id) -> update(['inStock' => empty($request -> input('inStock')) ? 0 : 1]);
            if($result['success'])
                $result['text'] = "Stock updated successfully.";
            else{
                $result['code'] = 156;
                $result['text'] = "Request error: Improper stock.";
            }
        }
        return $result;
    }

}
