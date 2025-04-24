@extends('layouts.vertical', ['subtitle' => 'Blogs '])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Darkone', 'subtitle' => 'Blogs'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('blogs.create') }}" class="btn btn-primary float-end">Create Blogs</a>
        <div id="table-projects" style="overflow: auto"></div>

    </div>
</div>



@endsection

@section('scripts')
<script>
    window.csrfToken = "{{ csrf_token() }}";

    window.gridConfigs = [
        {
            elementId: "table-projects",
            columns: @json($columns),
            data: @json($data),
            routes: {
                edit: "{{ route('blogs.edit' , ':id') }}",
                delete: "{{ route('blogs.destroy' , ':id') }}",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
