@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    @role('admin')
    <article-form 
        role="admin"  
        :categories="'{{($categories)}}'"
        :langs="'{{json_encode((array)$langs)}}'"
        :save_article = "'{{route('admin.article.edit')}}'"
        :article_title="'{{$article->title}}'"
        :article_id="{{$article->id}}"
        :article_body ="'{{$article->body}}'"
        :article_lang="'{{$article->language}}'"
        :article_cat="'{{$article->category_id}}'"
        article_edit="yes"
    >
    </article-form>
    @endrole

    @role('sub_admin')
    <article-form 
        role="sub_admin"  
        :categories="'{{($categories)}}'"
        :langs="'{{json_encode((array)$langs)}}'"
        :save_article = "'{{route('admin.article.edit')}}'"
        :article_title="'{{$article->title}}'"
        :article_id="{{$article->id}}"
        :article_body ="'{{$article->body}}'"
        :article_lang="'{{$article->language}}'"
        :article_cat="'{{$article->category_id}}'"
        article_edit="yes"
    >
    </article-form>
    @endrole
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form method="POST" action="{{route('admin.article.edit')}}">
                    @csrf
                    <input type="hidden" name="article_id" value="{{$article->id}}">
                    <div class="form-group">
                        <label>Title </label>
                        <input type="text" name="title" value="{{$article->title}}" class="form-control">
                    </div> 
                    <hr>
                    <div class="form-group">
                        <label>Aritcle .</label>
                        <textarea name="body" rows="20" class="form-control">
                            {{$article->body}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn badge-info" style="width: 100%" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</div>
@endsection