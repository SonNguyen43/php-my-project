
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
            <h2 class="d-inline"><b>Tạo mới món ăn</b></h2>

            {!!Form::open(['action'=>'FoodsController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::label('Tên món ăn:','Tên món ăn:')}} (<span class="text-danger">*</span>)
                {{Form::text('name','', ['class'=>'form-control'])}}

                {{Form::label('Mô tả:','Mô tả:')}}(<span class="text-danger">*</span>)
                {{Form::textarea('description','', ['class'=>'form-control', 'id'=>'article-ckeditor'])}}

                <div class="row mb-0">
                    <div class="col-md-6">
                        {{Form::label('Ảnh minh họa:','Ảnh minh họa:')}}(<span class="text-danger">*</span>)
                        <div class="custom-file">
                            {{Form::file('image', ['accept'=>'image/*','class'=>'custom-file-input', 'id'=>'validatedCustomFile'])}}
                            <label class="custom-file-label" for="validatedCustomFile">Chọn file ảnh...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{Form::label('Danh mục của món ăn:','Danh mục của món ăn:')}}(<span class="text-danger">*</span>)
                        <select class="form-control" name="categories_id">
                            @foreach ($create_food as $caterogy)
                                <option value="{{$caterogy->id}}">{{$caterogy->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Tạo mới</button>
                </div>
                
			{!!Form::close()!!}
        </div>
    </div>
</div>

