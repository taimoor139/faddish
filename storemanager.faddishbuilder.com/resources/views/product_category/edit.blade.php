{{Form::model($productCategorie, array('route' => array('product_categorie.update', $productCategorie->id), 'method' => 'PUT')) }}
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('name',__('Name'),array('class'=>'col-form-label'))}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Product Category')))}}
                @error('name')
                <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
    <button type="submit" class="btn  btn-primary">{{__('Update')}}</button>
</div>
{{Form::close()}}
