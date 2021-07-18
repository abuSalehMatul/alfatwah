<div class="form-group row">
  <label for="title" class="col-sm-2 col-form-label">{{__('Question Title')}}</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" required id="title" name="title">
  </div>
</div>
{{-- <div class="form-group row">
  <label for="language" class="col-sm-2 col-form-label">{{__('Language')}}</label>
  <div class="col-sm-10">
    <select class="form-control" required id="language" name="language">
      <option value="">{{__('Select a language')}}</option>
      @foreach($languages as $short_name => $language)
      <option value="{{$short_name}}" {{$short_name == $APP_LOCALE ? 'selected' : ''}} >{{$language}}</option>
      @endforeach
    </select>
  </div>
</div> --}}
{{-- <div class="form-group row">
  <label for="category" class="col-sm-2 col-form-label">{{__('Category')}}</label>
  <div class="col-sm-10">
    <select class="form-control" required id="category" name="category_id">
      <option value="">{{__('Select Category')}}</option>
      @foreach($categories as $key => $category)
      <option value="{{$category->id}}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
</div> --}}
<div class="form-group row">
  <label for="description" class="col-sm-2 col-form-label">{{__('Question Description')}}</label>
  <div class="col-sm-10">
    <textarea class="form-control" required id="description" name="description"></textarea>
  </div>
</div>