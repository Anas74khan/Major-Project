<p align="center">Major Project API</p>

## About

This API is build using Laravel framework. This is for our University major project.

### Version 0.0.1

currently only having some basic functionality such as getting the pages sliders, products , categories, subcategories, login, register, cart, orders and address management

#### Below mentioned request are type of get request and does not require login

-   sliders
    -   api/sliders for home page sliders.
    -   api/sliders/{slug} for category sliders.
-   api/categories for Categories.
-   api/tags/categories for Categories.
-   api/tags/subcategories/{category-slug} for subCategories.
-   api/tags/brands/{category-slug} for subCategories.
-   Products
    -   api/products for getting 20 top rated products.
    -   api/products/{category-slug} for getting 20 top rated products of a category.
    -   api/products/{category-slug}/{subcategory-slug} for getting 20 top rated products of a category and subcategory.
    -   api/products/{category-slug}/{subcategory-slug}/{brand-slug} for getting 20 top rated products of a category, subcategory and brand.
    -   api/products/{category-slug}/{subcategory-slug}/{brand-slug}/{from} for getting 20 top rated products of a category, subcategory and brand starting from a particular number.
        -   Say {from} = 3 it will skip first 2 products.
    -   api/products/{category-slug}/{subcategory-slug}/{brand-slug}/{from}/{limit} for getting top rated products of a category, subcategory and brand upto specified limit.
    -   api/products/{category-slug}/{subcategory-slug}/{brand-slug}/{from}/{limit}/{order_by} get specified products sorted by order_by value default is rating.
    -   Slugs can have value all for ignoring particular slug, from and limit can have value greater than 1.

#### Below mentioned request require login and type is mention after them

-   api/login.
    -   Type : POST
    -   Parameter
        -   username
        -   password
-   api/register.
    -   Type : POST
    -   Parameter
        -   name
        -   username
        -   password
        -   email
-   api/cart
    -   Type : GET
    -   Function : Provides all the products in cart.
-   api/cart
    -   Type : POST
    -   Function : Adds a product in cart.
    -   Parameter
        -   productId
        -   varietyId
-   api/cart
    -   Type: PUT
    -   Function : Update quantity of a product in cart.
    -   Parameter
        -   id {which is the cart id}
        -   quantity
-   api/cart/{id} {which is the cart id}
    -   Type : DELETE
    -   Function : Remove a product from cart.
-   api/address
    -   Type : GET
    -   Function : Provides all the address of the user.
-   api/address
    -   Type : POST
    -   Function : Adds a address for user.
    -   Parameter
        -   name
        -   mobileNo
        -   address1
        -   address2 {optional}
        -   pincode
        -   city
        -   state
        -   type [Home/Office] {optional by default is Home}
-   api/address
    -   Type: PUT
    -   Function : Update address of a user.
    -   Parameter
        -   id {which is the address id}
        -   name
        -   mobileNo
        -   address1
        -   address2 {optional}
        -   pincode
        -   city
        -   state
        -   type [Home/Office] {optional by default is Home
-   api/address/{id} {which is the address id}
    -   Type : DELETE
    -   Function : Remove a address of user.
-   api/useaddress/{id} {which is the address id}
    -   Type : PUT
    -   Function : Enables inUse flag of address.
-   api/orders or api/orders/{from} {where from is an integer value greater than 0}
    -   Type : GET
    -   Function : Provides the latest 20 orders from the specified number {from}
-   order/cart
    -   Type : POST
    -   Function : Order all the products that are in cart
    -   Parameter
        -   name
        -   mobileNo
        -   address1
        -   address2 {optional}
        -   pincode
        -   city
        -   state
        -   type [Home/Office] {optional by default is Home
-   order/{id} {which is the order id}
    -   Type : DELETE
    -   Function : Cancel the order with the provided order id and if it is not out for delivery.

### Version 0.0.1

    - Initial release
