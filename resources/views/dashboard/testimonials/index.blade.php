@extends('layouts.vertical', ['subtitle' => 'Testimonials'])

@section('content')

@include('layouts.partials.page-title', ['title' => 'Darkone', 'subtitle' => 'Testimonials'])

<style>
    .table-responsive {
    overflow-x: auto;
    width: 100%;
}

</style>
<div class="card">

    <div class="card-body">
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary float-end">Create Testimonials</a>
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
                edit: "{{ route('testimonials.edit' , ':id') }}",
                delete: "{{ route('testimonials.destroy' , ':id') }}",
            }
        }
    ];
</script>

@vite(['resources/js/pages/table-gridjs.js'])
@endsection
