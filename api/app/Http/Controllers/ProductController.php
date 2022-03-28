<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Variety;

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

    public function product($id = 0){
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


        return ['success' => true,'product' => $product];
    }

}
