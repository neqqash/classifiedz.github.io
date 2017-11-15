@extends('layouts.app')

@section('title', 'Edit Ad')

@section('content')

<div class="container-fluid py-5">
  <div class="row-fluid">
    <div class="container col-sm-8">
      <h2>Update Your Ad &nbsp;<span class="badge badge-default">{{$product->title}}</span></h2>
      <form method="POST"  enctype="multipart/form-data" action="{{ route('updateAd') }}">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $product->id }}">

        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
          <label for="category_id">What category does your product fall under:</label>
          <select class="form-control" id="category_id" name="category_id">
            @foreach ($categories as $category)
            <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif> {{ $category->name }}</option>
              @foreach ($category->children as $categoryTier2)
              <option value="{{$categoryTier2->id}}" @if($categoryTier2->id == $product->category_id) selected @endif>&emsp;{{ $categoryTier2->name }}</option>
                @foreach ($categoryTier2->children as $categoryTier3)
                <option value="{{$categoryTier3->id}}" @if($categoryTier3->id == $product->category_id) selected @endif>&emsp;&emsp;{{ $categoryTier3->name }}</option>
                @endforeach
              @endforeach
            @endforeach
          </select>

          @if ($errors->has('category_id'))
          <span class="help-block">
            <strong>{{ $errors->first('category_id') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          <label for="title">Item you're selling:</label>
          <input type="text" class="form-control" id="title" placeholder="Product..." name="title" value="{{ (old('title') !== null) ? old('title') : $product->title }}">
          @if ($errors->has('title'))
          <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          <label for="description">Description:</label>
          <textarea class="form-control" rows="5" name="description" id="description" placeholder="Describe what you're selling... ">{{ (old('description') !== null) ? old('description') : $product->title }}</textarea>
          
          @if ($errors->has('description'))
          <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
          <label for="price">How much are you selling this item for:</label>
          <input type="text" class="form-control" id="price" name="price" value="{{ (old('price') !== null) ? old('price') : $product->price }}">

          @if ($errors->has('price'))
          <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
          </span>
          @endif
        </div>

        <div>
        	<label for="currImage">Your current image of product:&nbsp;</label>
        	<img id="currImage" src="{{ asset($product->image) }}" height="80">
        </div>
        <br>
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
          <label for="image">Upload a new image of your product (not necessary):</label>
          </br>
          <input id="image" name="image" type="file" value="{{ old('image') }}">

        @if ($errors->has('image'))
        <span class="help-block">
          <strong>{{ $errors->first('image') }}</strong>
        </span>
        @endif
      </div>
      <!-- <div class="form-group">
        <label for="contact">How would you prefer to be contacted?</label>
        <div class="radio">
          <label class="px-4"><input type="radio" name="contact" value="call"> Call</label>
        </div>
        <div class="radio">
          <label class="px-4"><input type="radio" name="contact" value="text"> Text</label>
        </div>
        <div class="radio">
          <label class="px-4"><input type="radio" name="contact" value="email"> Email</label>
        </div>
      </div> -->
    </br></br>
    <div class="checkbox">
      <label><input type="checkbox" name="agree"> <small>I have read and agree to the <a href="#">Terms and Conditions</a></small></label>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="/store" class="btn btn-danger"  role="button">Cancel</a>
  </form>
</div>
</div>
</div>

@endsection