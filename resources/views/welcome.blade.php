@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Image</div>

                <div class="card-body">
                    <form method="POST" id="formbuku" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="jenis" class="col-md-2 col-form-label text-md-right">Jenis</label>

                            <div class="col-md-8">
                                <select name="jenis" id="jenis" class="custom-select" required>
                                    <option value="Nota">Nota</option>
                                    <option value="Pelunasan">Pelunasan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-file" class="col-md-2 col-form-label text-md-right">File</label>

                            <div class="col-md-8">
                                <input type="file" id="input-file" accept="image/jpg,image/jpeg,image/png" name="input-file" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right"></label>

                            <div class="col-md-8">
                                <img id="image-preview" class="w-100" src="">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <label class="col-md-2 col-form-label text-md-right"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    SIMPAN
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('script')
    <script>
        $("input[type='file']").change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onloadend = function(){
                $("#image-preview").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        });

        


    $(document).ready(function() {

        $('#formbuku').on('submit', function(event){
            event.preventDefault();

            // ambil semua inputan di form dan di tambahi array menu----------
            var fd =  new FormData(this);
            // fd.append('mode', mod);

            $.ajax({
                url:"{{ route('upload.store') }}",
                method:"POST",
                data: fd,
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        // console.log(data.errors.keys);
                        for(var count = 0; count < data.errors.keys.length; count++)
                        {  
                            var v = document.getElementById(data.errors.keys[count]);
                            if($(v).is("input")){
                                v.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(v);
                            }

                            if($(v).is("select")){
                                var w = v.nextSibling;
                                w.classList.add('is-invalid');
                                $("<span class='invalid-feedback' role='alert' style='display:block'>" + data.errors.message[count] + "</span>").insertAfter(w);
                            }
                        }
                    }
                    if(data.success)
                    {
                        console.log(data);
                        $('#formbuku')[0].reset();
                        $("#image-preview").attr("src", "");
                        alert('Penyimpanan Image telah berhasil... ^_^');
                    }
                    if(data.error){
                        console.log(data);
                        alert(data.error);
                    }
                    
                }
            })
        });


    });
    </script>
@endsection