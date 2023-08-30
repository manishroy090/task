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
            <form id="categoryform" class="bg-slate-300  flex  flex-col w-96 h-64  space-y-4 px-4 py-4 mt-20 ml-20">
                <h1 class="ml-10 font-extrabold text-2xl">Add Category Here</h1>
                <input type="text" name="category"="w-full hclass-20 text-2xl font-extrabold text-center" id="category" placeholder="Category">
                <p id="errormsg" class="text-red-600"></p>
                <button type="submit" class="bg-blue-600 px=1 py-4 text-2xl text-white font-extrabold">Submit</button>
            </form>
        </div>
        <div class="flex justify-center mt-20">

            <table class="table-auto">
                <thead>
                    <tr class=" border border-black">
                        <th class="px-8 border border-black"> SN</th>
                        <th class="px-8 border border-black"> Categories</th>
                        <th class="px-10 border border-black"> Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @forelse ($categories as $key=> $category)
                    <tr id="row_{{$category->id}}">
                        <td class="px-8 border border-black">{{$key+1}} </td>
                        <td id="td_{{$category->id}}" class="border border-black px-4"> {{$category->category}}</td>
                        <td class="border border-black px-8 py-4">

                            <button class="edits px-4 py-4 bg-blue-600 font-extrabold border rounded-md text-white" data-id="{{$category->id}}">Edit</button>
                            <button class=" delete px-4 py-4 font-extrabold bg-red-600 text-white rounded-md" data-id="{{$category->id}}">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <td colspan="3" id="norec" class="border border-black text-center py-8">
                        "no Records Founds"
                    </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
<script>
    $(document).ready(function() {
        var form = $('#categoryform')[0];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var processFor = '';
        var processFor = $('#update').val("add");

        $(document).on('click', '.edits', function() {
            processFor.val("update");
        });


        $('#categoryform').on('submit', function(e) {
            var tbody = $('#tbody');
            e.preventDefault();

            let updurl = $('#updateurl').val();
            var url = " ";
            console.log(processFor.val());
            if (processFor.val() == "add") {

                url = "{{route('category.store')}}";

            }
            if (processFor.val() == "update") {

                url = updurl;
            }
            console.log(url);
            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#errormsg').empty();
                    if (response.action == "Added") {

                        var tr =
                            `<tr id="row_${response[0].id}">  <td class="px-8 border border-black">${response.index}</td><td class="border border-black px-4" id="td_${response[0].id}"> ${response[0].category}</td>
                            <td class="border border-black px-8 py-4">
                            <button   class="edits px-4 py-4 bg-blue-600 font-extrabold border rounded-md text-white" data-id="${response[0].id}">Edit</button>
                            <button   class=" delete px-4 py-4 font-extrabold bg-red-600 text-white rounded-md" data-id="${response[0].id}">Delete</button>
                            </td>
                        </tr>`
                        tbody.append(tr);
                        $('#norec').hide();

                    } else {
                        $('#td_' + response.id).html(response[0].category);
                        $('#update').val("add");
                    }
                    swal("Sucessfully!", 'Category  ' + response.action, "success")
                    form.reset();

                },
                error: function(error) {
                    $('#errormsg').html(error.responseJSON.message);

                }
            })
        })

        $(document).on('click', '.edits', function() {
            let id = $(this).data('id');
            var editurl = "{{route('category.edit','id')}}";
            editurl = editurl.replace('id', id);
            var updateurl = "{{route('category.update','id')}}";
            updateurl = updateurl.replace('id', id);
            $('#updateurl').val(updateurl);
            $.ajax({
                url: editurl,
                method: 'GET',
                success: function(response) {
                    $('#category').val(response[0].category);
                },
                error(error) {
                    console.log(error);
                }
            });

        })
        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            let deleteUrl = "{{route('category.delete','id')}}";
            deleteUrl = deleteUrl.replace('id', id);
            $.ajax({
                url: deleteUrl,
                method: "GET",
                success: function(response) {
                    console.log(response)
                    $("#row_" + response.id).remove();
                    swal("Sucessfully!", 'Category  ' + response.action, "success");
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })
    })
</script>