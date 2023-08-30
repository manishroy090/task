<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>
    <div class="flex space-x-32">
        <div>
            <form id="productform" class="bg-slate-300  flex  flex-col w-fit  space-y-4 px-4 py-4 mt-20 ml-20" enctype="multipart/form-data">
                <h1> Add Product</h1>
                <input type="hidden" placeholder="url" id="update">
                <input type="hidden" placeholder="updateurl" id="updateurl">
                <div>
                    <div class="flex flex-row">
                        <div class="flex flex-col">

                            <div class="flex flex-col">
                                <label for="productname">Product Name</label>
                                <input type="text" name="productname" class="w-96" id="productname">
                                <p id="productnameerr" class="text-red-600"></p>
                            </div>


                            <div class="flex flex-col">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="w-96" id="price">
                                <p id="priceerr" class="text-red-600"></p>
                            </div>

                        </div>
                        <img src="" width="100px" height="100px" class="ml-32" id="showimg">
                    </div>
                    <div class="flex flex-row">
                        <div>
                            <label for="img">Select Img</label>
                            <input type="file" name="imgupload" class="w-full" id="img">
                            <p id="imgeerr" class="text-red-600"></p>
                        </div>

                        <div class="mt-6">
                            <label for="brand">Brand</label>
                            <select name="brand" id="brand">
                                <option value="">Select</option>
                                @foreach ($branList as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                            <p id="brandeerr" class="text-red-600"></p>
                        </div>
                        <div class="mt-6 ml-10">
                            <label for="category">Category</label>
                            <select name="category" id="category">
                                <option value="">Select</option>
                                @foreach ($categoryList as $category )
                                <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                            <p id="categoryeerr" class="text-red-600"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description"> Description:</label>
                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        <p id="descreerr" class="text-red-600"></p>
                    </div>
                </div>


                <button type="submit" class="bg-blue-600 px=1 py-1 text-white">Submit</button>
            </form>
        </div>
        <div class="mt-20">
            <table>
                <thead>
                    <tr class="border border-black">
                        <th class="px-8 border border-black font-extrabold">
                            SN
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Product Name
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Image
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Price
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Brand
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Category
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Description
                        </th>
                        <th class="px-8">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @forelse ($productlist as $key=> $product)
                    <tr id="row_{{$product->id}}" class="border border-black ">
                        <td class="px-8">{{$key+1}} </td>
                        <td id="productname_{{$product->id}}" class="px-8 border border-black">
                            {{$product->productname}}
                        </td>
                        <td id="img_{{$product->id}}" class="px-8 py-4 border border-black">
                            <img src="{{asset('/storage/uploads/' . $product->imgupload)}}" width="100px" height="100px" id="rowimg_{{$product->id}}">
                        </td>
                        <td id="price_{{$product->id}}" class="px-8 border border-black">
                            {{$product->price}}
                        </td>
                        <td id="brand_{{$product->id}}" class="px-8 border border-black">
                            {{$product->getBrand()->first()->name}}
                        </td>
                        <td id="category_{{$product->id}}" class="px-8 border border-black">
                            {{$product->getCategory()->first()->category}}
                        </td>
                        <td id="description_{{$product->id}}" class="px-8 border border-black">
                            {{strip_tags($product->description)}}
                        </td>
                        <td class="px-8">
                            <button class="edits px-4 font-extrabold border rounded-mmd py-4 bg-blue-600 text-white" data-id="{{$product->id}}">Edit</button>
                            <button class=" delete px-4 py-4  bg-red-600 text-white font-bold rounded-md" data-id="{{$product->id}}">Delete</button>
                        </td>
                    </tr>


                    @empty
                    <tr>
                        <td colspan="8" id="norec" class="border border-black text-center py-8">
                            "no Records Founds"
                        </td>

                    </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
    </div>


</x-app-layout>
<script>

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#showimg').hide();
        var form = $('#productform')[0];
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(newEditor => {
                window.editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('#category').multiselect();
        $('#brand').select2({
            ajax: {
                url: "{{route('brandlist')}}",
                data: function(params) {
                    return {
                        term: params.term,
                        type: 'brand'
                    };
                },
                allowclear: true,
                cache: true
            }
        });
        var processFor = $('#update');
        processFor.val('add')
        $('.edits').click(function() {
            processFor.val('update');
        })
        let tbody = $('#tbody');
        $('#productform').on('submit', function(e) {
            e.preventDefault();
            var url = ''

            if (processFor.val() == "add") {
                url = "{{route('store')}}"
            }
            if (processFor.val() == "update") {
                url = $('#updateurl').val();
            }
            var errorList = '';
            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response.action == "Added") {

                        let tr = `<tr class="border border-black " id="row_${response.id}"> <td class="px-8"> ${response.index+1}</td> <td class="px-8 border border-black" id="productname_${response.id}">${response[0].productname}</td><td class="px-8 py-4 border border-black"><img id="rowimg_${response.id}" src="${response[0].imgupload}" width="100px" height="100px"></td><td class="px-8 border border-black" id="price_${response.id}">${response[0].price} </td> <td class="px-8 border border-black" id="brand_${response.id}">${response[0].brand}</td><td class="px-8 border border-black" id="category_${response.id}">${response[0].category}</td> <td class="px-8 border border-black">${response[0].description}</td>
                    <td class="px-8">
                      <button class="edits px-4 font-extrabold border rounded-mmd py-4 bg-blue-600 text-white" data-id="${response[0].id}">Edit</button>
                      <button class="delete px-4 py-4  bg-red-600 text-white font-bold rounded-md" data-id="${response[0].id}">Delete</button>
                    </td></tr>`
                        tbody.append(tr);

                        $('#norec').remove();
                    }
                    $('#productname_' + response.id).html(response[0].productname)
                    $('#rowimg_' + response.id).removeAttr('src');
                    $('#rowimg_' + response.id).attr('src', response[0].imgupload)
                    $('#price_' + response.id).html(response[0].price);
                    $('#brand_' + response.id).html(response[0].brand);
                    $('#category_' + response.id).html(response[0].category)
                    $('#description_' + response.id).html(response[0].description);
                    swal("Sucessfully!", 'Category  ' + response.action, "success")
                    form.reset();
                    $('#brand').val(' ').trigger("change");
                    $('#category').val(' ');
                    $("#category").multiselect("refresh");
                    window.editor.setData(' ');
                },
                error: function(error) {
                    console.log(error.responseJSON.errors);
                    errorList = error.responseJSON.errors;
                    errors(errorList);
                }

            })

            function errors(errorList, response) {
                if (errorList) {
                    errorList.productname ? $('#productnameerr').html(errorList.productname) : $('#productnameerr').html('');
                    errorList.price ? $('#priceerr').html(errorList.price) : $('#priceerr').html('');
                    errorList.imgupload ? $('#imgeerr').html(errorList.imgupload) : $('#imgeerr').html('');
                    errorList.brand ? $('#brandeerr').html(errorList.brand) : $('#brandeerr').html('');
                    errorList.category ? $('#categoryeerr').html(errorList.category) : $('#categoryeerr').html('');
                    errorList.description ? $('#descreerr').html(errorList.description) : $('#descreerr').html('');

                }
                if (response) {
                    $('#productnameerr').html('');
                    $('#priceerr').html('');
                    $('#imgeerr').html('');
                    $('#brandeerr').html('');
                    $('#categoryeerr').html('');
                    $('#descreerr').html('');
                }
            }
        });
        $(document).on('click', '.edits', function() {
            $('#showimg').show();
            let id = $(this).data('id');
            let editurl = "{{route('product.edit','id')}}";
            editurl = editurl.replace('id', id);
            let updateurl = "{{route('product.update','id')}}";
            updateurl = updateurl.replace('id', id);

            $.ajax({
                url: editurl,
                method: "GET",
                success: function(response) {
                    $('#productname').val(response.product.productname);
                    $('#price').val(response.product.price);
                    $('#showimg').attr('src', response.product.imgupload)
                    $('#brand').val(response.product.brand)
                    $('#category').val(response.product.category);
                    $("#category").multiselect("refresh");
                    window.editor.setData(response.product.description);
                    $('#updateurl').val(updateurl);

                },
                error: function() {



                }
            })
        });
        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            let deleteurl = "{{route('product.delete','id')}}";
            deleteurl = deleteurl.replace('id', id);
            $.ajax({
                url: deleteurl,
                method: 'GET',
                success: function(response) {
                    $('#row_' + response.id).remove();
                    swal("Sucessfully!", 'Category  ' + response.action, "success")
                },
                error: function(error) {

                }
            })
        })

    })
</script>