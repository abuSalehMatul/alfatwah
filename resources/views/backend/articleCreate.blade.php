@extends('backend.layouts.master')
@section('content')
<div class="container-fluid">
    @role('admin')
    <article-form 
        role="admin"  
        :categories="'{{($categories)}}'"
        :langs="'{{json_encode((array)$langs)}}'"
        :save_article = "'{{route('admin.article.create.save')}}'"
        article_edit="no"
    >
    </article-form>
    @endrole

    @role('sub_admin')
    <article-form 
        role="sub_admin"  
        :categories="'{{($categories)}}'"
        :langs="'{{json_encode((array)$langs)}}'"
        :save_article = "'{{route('admin.article.create.save')}}'"
        article_edit="no"
    >
    </article-form>
    @endrole
    
</div>
@endsection