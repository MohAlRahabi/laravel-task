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
        <h2>Blogs :</h2>
        <div class="row" id="blogs-container">

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $.ajax({
                url:"{{route('getBlogs')}}",
                success:function (data) {
                    let blogs = data.data;
                    if(blogs.length > 0) {
                        blogs.map(single => {
                            $('#blogs-container').append(`
                                <div class="single-blog col-sm-12 col-md-6 col-lg-3">
                                    <div class="card">
                                        <div style='width: 100%;height: 100px;background-image: url("${single.image}");background-position: center;background-size: contain;background-repeat: no-repeat;'></div>
                                        <div class="card-body">
                                            <h5 class="card-title">${single.title}</h5>
                                            <p class="card-text">${single.short_content}</p>
                                            <a href="{{route("singleBlog")}}?id=${single.id}" class="btn btn-dark">View</a>
                                        </div>
                                    </div>
                                </div>

                            `)
                        })
                    }
                }
                ,error:function () {
                    $('#blogs-container').append(
                        `<h2>There is no Data</h2>`
                    );
                }
            })
        })
    </script>
@endpush
