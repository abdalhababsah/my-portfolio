@extends('layouts.vertical')

@section('title', 'Projects')


@section('content')
    <!-- Start Content-->
  
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Projects</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ route('admin.projects.create') }}" class="btn btn-danger mb-2">
                                    <i class="mdi mdi-plus-circle mr-2"></i> Add Project
                                </a>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Featured</th>
                                        <th>Images</th>
                                        <th>Videos</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{ $project->id }}</td>
                                            <td>
                                                @if($project->cover_image)
                                                    <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title_en }}" width="50">
                                                @else
                                                    <span class="badge badge-warning">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $project->title_en }}</td>
                                            <td>{{ $project->category->name_en ?? 'N/A' }}</td>
                                            <td>
                                                @foreach($project->tags as $tag)
                                                    <span class="badge badge-info">{{ $tag->name_en }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.projects.toggle-featured', $project->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm {{ $project->featured ? 'btn-success' : 'btn-secondary' }}">
                                                        {{ $project->featured ? 'Yes' : 'No' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $project->images->count() }}</td>
                                            <td>{{ $project->videos->count() }}</td>
                                            <td class="table-action">
                                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="action-icon">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="action-icon delete-btn" data-toggle="modal" data-target="#delete-modal" data-id="{{ $project->id }}" data-url="{{ route('admin.projects.destroy', $project->id) }}">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->

    <!-- Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Delete Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this project? This action cannot be undone.</p>
                    <div class="text-right">
                        <form id="delete-form" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
