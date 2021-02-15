
<style>
    input{
        border: none;
        outline: none;
        width: 100%;
    }

    input.search{
        border-bottom: 1px solid #000;
        outline: none;
        width: 100%;
    }

    input:focus{
        border-bottom: 1px solid #38c172;
    }
</style>

<div class="card shadow-sm mt-3 mb-3">
    <div class="info">
        <div class="">
            <h2 class="d-inline"><b>Thay đổi nội dung danh mục</b></h2>

            {!!Form::open(['action'=>['CategoriesController@update',$edit_categorie->id], 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::label('Tên món ăn:','Tên món ăn:')}} (<span class="text-danger">*</span>)
                {{Form::text('name',$edit_categorie->name, ['class'=>'form-control'])}}

                    {{Form::label('Ảnh minh họa:','Ảnh minh họa:')}}
                    <div class="custom-file">
                        {{Form::file('image', ['accept'=>'image/*','class'=>'custom-file-input', 'id'=>'validatedCustomFile'])}}
                        <label class="custom-file-label" for="validatedCustomFile">Chọn file ảnh...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                   
                <div class="d-flex justify-content-end">
                    {{Form::hidden('_method','PUT')}}
                    <button type="submit" class="btn btn-success">Chỉnh sửa</button>
                </div>
			{!!Form::close()!!}
        </div>
    </div>
</div>
