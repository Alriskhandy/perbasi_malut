<section id="blog-pagination" class="blog-pagination section">
    <div class="container">
        <div class="d-flex justify-content-center">
            <!-- Laravel Pagination Links -->
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
