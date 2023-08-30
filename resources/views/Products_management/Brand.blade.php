<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>
    <div class="flex justify-center space-x-32">
        <input type="hidden" placeholder="url" id="update" class="h-10">
        <input type="hidden" placeholder="updateurl" id="updateurl" class="h-10">
        <div>
            <form id="brandform" class="bg-slate-300  flex  flex-col w-96 h-86  space-y-4 px-4 py-4 mt-20 ml-20">
                <h1>Add Brand Here</h1>
                <input type="text" name="name" class="w-full h-16 text-2xl text-center" id="category" placeholder="Brand Name">
                <p id="errormsg" class="text-red-600"></p>
                <button type="submit" class="bg-blue-600 px=1 py-1 text-white">Submit</button>
            </form>
        </div>
        <div class="flex justify-center mt-20">
            <table>
                <thead>
                    <tr class=" border border-black">
                        <th class="px-8 border border-black font-extrabold">
                            SN
                        </th>
                        <th class="px-8 border border-black font-extrabold">
                            Categories
                        </th>
                        <th class="px-8 border border-black font-extrabold ">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @forelse ($brands as $key=> $brand)

                    <tr id="row_{{$brand->id}}">
                        <td class="px-8 border border-black">{{$key+1}} </td>
                        <td id="td_{{$brand->id}}" class="px-8 border border-black">
                            {{$brand->name}}
                        </td>
                        <td class="px-8 border border-black py-4">
                            <button class="edits px-4 py-4 bg-blue-600 text-white font-extrabold border rouneded-md" data-id="{{$brand->id}}">Edit</button>
                            <button class=" delete px-4 py-4 bg-red-600 text-white font-extrabold border rouneded-md" data-id="{{$brand->id}}">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" id="norec" class="border border-black text-center py-8">
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
    $(document).ready(function() {
        var form = $('#brandform')[0];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var processFor = ''
        processFor = $('#update').val("add");
        $(document).on('click', '.edits', function() {
            processFor.val("update");
        })


        $('#brandform').on('submit', function(e) {
            var tbody = $('#tbody');
            event.preventDefault();
            var url = '';

            if (processFor.val() == "add") {
                url = "{{route('brand.store')}}";
            }
            if (processFor.val() == "update") {
                url = $('#updateurl').val();
            }
            console.log(url);
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.action == "Added") {
                        let tr = `<tr id="row_${response.brand.id}">  <td class="px-8 border border-black">${response.totalnumber}</td><td class="px-8 border border-black" id="td_${response.brand.id}"> ${response.brand.name}</td>
                            <td class="px-8 border border-black py-4">
                            <button   class="edits px-4 py-4 bg-blue-600 text-white font-extrabold border rouneded-md" data-id="${response.brand.id}">Edit</button>
                            <button   class=" delete px-4 py-4 bg-red-600 text-white font-extrabold border rouneded-md" data-id=${response.brand.id}>Delete</button>
                            </td>
                        </tr>`
                        tbody.append(tr);
                        $('#norec').hide();

                    } else {

                        $('#td_' + response.id).html(response.updatedData.name)
                        $('#update').val("add");
                    }
                    $('#errormsg').empty()
                    swal("Sucessfully!", 'Category  ' + response.action, "success")
                    form.reset();
                },
                error: function(error) {
                    let errorList = error.responseJSON.errors;
                    if (errorList) {
                        $('#errormsg').html(errorList.name)
                    }

                }
            })

        });
        $(document).on('click', '.edits', function() {

            let id = $(this).data('id');
            let editurl = "{{route('brand.edit','id')}}";
            editurl = editurl.replace('id', id);
            let updateurl = "{{route('brand.update','id')}}";
            updateurl = updateurl.replace('id', id);
            $('#updateurl').val(updateurl);

            console.log(editurl);
            $.ajax({
                url: editurl,
                method: 'GET',
                success: function(response) {
                    $('#category').val(response.name);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        });
        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            var deleteurl = "{{route('brand.delete','id')}}";
            deleteurl = deleteurl.replace('id', id)
            $.ajax({
                url: deleteurl,
                method: 'GET',
                success: function(response) {

                    $('#row_' + response.id).remove();
                    swal("Sucessfully!", 'Category  ' + response.action, "success")
                },
                error: function(error) {
                    console.log(error);
                }


            })
        });

    })
</script>