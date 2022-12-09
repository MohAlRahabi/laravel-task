@extends('frontend.layout.main')
@section('extra_meta')
    <meta name="description" content="{{env('DESCRIPTION')}}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{env('APP_NAME', 'laravel')}}">
    <meta itemprop="description" content="{{env('DESCRIPTION')}}">
    <meta itemprop="image" content="{{env('APP_URL')}}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{env('APP_NAME', 'laravel')}}">
    <meta property="og:description" content="{{env('DESCRIPTION')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{env('APP_NAME', 'laravel')}}">
    <meta name="twitter:description" content="{{env('DESCRIPTION')}}">
@endsection
@section('content')
    <div class="container">
        <h2 id="title"></h2>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div id="image" style='width: 100%;height: 300px;background-position: center;background-size: contain;background-repeat: no-repeat;'>

                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="row flex-column">
                    <p><strong>Content</strong></p>
                    <p id="content"></p>
                    <p><strong>Published At</strong></p>
                    <p id="publish_date"></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            let blog_id = getParameterByName('id');
            $.ajax({
                url:"{{route('viewBlog')}}/"+blog_id,
                success:function (data) {
                    let blog = data.data;
                    if(blog) {
                        $("#title").html(blog.title)
                        $("#image").css("background-image",`url('${blog.image}')`)
                        $("#content").html(blog.content)
                        $("#publish_date").html(blog.publish_date)
                    } else{
                        history.back()
                    }
                }
                ,error:function () {
                    history.back()
                }
            })
        });
    </script>
@endpush
