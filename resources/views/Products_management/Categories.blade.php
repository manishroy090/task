<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>
    <div class="flex justify-center space-x-32">
        <div>
            <form id="categoryform" class="bg-slate-300  flex  flex-col w-96 h-64  space-y-4 px-4 py-4 mt-20 ml-20">
                <h1 class="ml-10 font-extrabold text-2xl">Add Category Here</h1>
                <input type="hidden" placeholder="url" id="update">
                <input type="hidden" placeholder="updateurl" id="updateurl">
                <input type="text" name="category" class="w-full h-20 text-2xl font-extrabold text-center" id="category" placeholder="Category">
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

                            <button class="edits px-4 py-4 bg-blue-600 font-extrabold border rounded-md text-white" data-editurl="{{route('category.edit',['id'=>$category->id])}}" data-updateurl="{{route('category.update',['id'=>$category->id])}}">Edit</button>
                            <button class=" delete px-4 py-4 font-extrabold bg-red-600 text-white rounded-md" data-deleteurl="{{route('category.delete',['id'=>$category->id])}}">Delete</button>
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

        $('.edits').click(function() {
            processFor.val("update");
        });


        $('#categoryform').on('submit', function(e) {
            var tbody = $('#tbody');
            e.preventDefault();

            let updurl = $('#updateurl').val();
            var url = " ";

            if (processFor.val() == "add") {

                url = "{{route('category.store')}}";
            }
            if (processFor.val() == "update") {

                url = updurl;
            }

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
                            `<tr>  <td class="px-8 border border-black">${response.index}</td><td class="border border-black px-4"> ${response[0].category}</td>
                            <td class="border border-black px-8 py-4">
                            <button   class="edits px-4 py-4 bg-blue-600 font-extrabold border rounded-md text-white">Edit</button>
                            <button   class=" delete px-4 py-4 font-extrabold bg-red-600 text-white rounded-md">Delete</button>
                            </td>
                        </tr>`
                        tbody.append(tr);
                        $('#norec').hide();

                    } else {
                        $('#td_' + response.id).html(response[0].category);

                    }
                    swal("Sucessfully!", 'Category  ' + response.action, "success")
                    form.reset();

                },
                error: function(error) {
                    $('#errormsg').html(error.responseJSON.message);

                }
            })
        })

        $('.edits').click(function() {
            var editurl = $(this).data('editurl');
            var updateurl = $(this).data('updateurl')
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
        $('.delete').on('click', function() {
            let deleteUrl = $('.delete').data('deleteurl');
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