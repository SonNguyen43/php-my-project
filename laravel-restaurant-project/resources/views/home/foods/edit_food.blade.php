
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
            <h2 class="d-inline"><b>Thay đổi nội dung món ăn</b></h2>

            {!!Form::open(['action'=>['FoodsController@update',$edit_food->id], 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::label('Tên món ăn:','Tên món ăn:')}} (<span class="text-danger">*</span>)
                {{Form::text('name',$edit_food->name, ['class'=>'form-control'])}}

                {{Form::label('Mô tả:','Mô tả:')}}(<span class="text-danger">*</span>)
                {{Form::textarea('description',$edit_food->description, ['class'=>'form-control', 'id'=>'article-ckeditor'])}}

                <div class="row mb-0">
                    <div class="col-md-4">
                        {{Form::label('Ảnh minh họa:','Ảnh minh họa:')}}
                        <div class="custom-file">
                            {{Form::file('image', ['accept'=>'image/*','class'=>'custom-file-input', 'id'=>'validatedCustomFile'])}}
                            <label class="custom-file-label" for="validatedCustomFile">Chọn file ảnh...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Danh mục:','Danh mục:')}}(<span class="text-danger">*</span>)
                        <select class="form-control" name="categories_id">
                            @foreach ($categories_edit as $category)
                                <option value="{{$category->id}}" @if ($category->id == $edit_food->categories_id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Món nổi bật:','Món nổi bật:')}}(<span class="text-danger">*</span>)
                        <select class="form-control" name="highlights">
                            <option value="true" @if ($edit_food->highlights == "true") selected @endif>Phải</option>
                            <option value="false" @if ($edit_food->highlights == "false") selected @endif>Không</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{Form::hidden('_method','PUT')}}
                    <button type="submit" class="btn btn-success">Chỉnh sửa</button>
                </div>
			{!!Form::close()!!}
        </div>
    </div>
</div>

