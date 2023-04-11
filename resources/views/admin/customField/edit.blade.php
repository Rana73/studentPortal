@extends('layouts.admin')
@section('title', 'Update Exam')
@section('admin-content')
    <main>
        <div class="container ">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{ route('dashboard') }}">Home</a> > Update Exam Name</span>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-cogs"></i>
                    Update Exam Name
                </div>
                <div class="card-body table-card-body p-3 mytable-body">
                    <form action="{{ route('exam.update', $exam->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Exam Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" value="{{ $exam->name }}" class="form-control custom-form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary float-right" value="Submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection

