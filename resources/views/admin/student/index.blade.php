@extends('layouts.admin')
@section('title', 'Manage Custom Field')
@section('admin-content')
    <main class="mb-5">
        <div class="container ">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Manage Custom Field</span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="table-head"><i class="fas fa-cogs me-1"></i>Add Custom Field Form</div>
                        </div>
                        <div class="card-body table-card-body p-3">
                            <form action="{{route('student.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="name">Name <span class="text-danger">*</span> </label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control custom-form-control form-control-sm shadow-none @error('name') is-invalid @enderror" id="name" placeholder="Enter Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="class"> class <span class="text-danger">*</span> </label>
                                        <input type="text" name="class" value="{{ old('class') }}" class="form-control custom-form-control form-control-sm shadow-none @error('class') is-invalid @enderror" id="class" placeholder="Enter Class">
                                        @error('class')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="email"> email <span class="text-danger">*</span> </label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control custom-form-control form-control-sm shadow-none @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="phone"> phone <span class="text-danger">*</span> </label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control custom-form-control form-control-sm shadow-none @error('phone') is-invalid @enderror" id="phone" placeholder="Enter Phone">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <!-- custom Field -->
                                    @foreach($field as $key => $item)
                                    <div class="col-md-6 col-12 mb-2">
                                        @if($item->type != 'boolean')
                                        <label for="class">{{ $item->title}}</label>
                                        <input type="{{ $item->type == 'boolean' ? 'checkbox' : $item->type }}" name="{{ $item->title}}" value="{{ old($item->title) }}" class="form-control custom-form-control form-control-sm shadow-none" placeholder="Enter {{$item->title}}">                                      
                                        @else
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Yes" id="checkbox{{$key}}" name="{{ $item->title}}">
                                            <label class="form-check-label" for="checkbox{{$key}}">
                                            {{ $item->title}}
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                    <!-- close custom Field -->
                                </div>
                                <div class="float-end">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mt-4">
            <div class="col-12 mt-md-0 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="table-head"><i class="fas fa-table me-1"></i>Custom Field List</div>
                        </div>
                        <div class="card-body table-card-body p-3">
                            <table id="datatablesSimple">
                                <thead class="text-center bg-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['class'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td>{{ $item['phone'] }}</td>
                                            <td class="text-center">
                                                @php
                                                    $json = json_encode([

                                                            'id'=>$item['id'],
                                                            'name'=> $item['name'],
                                                            'class'=>$item['class'],
                                                            'email'=>$item['email'],
                                                            'phone'=>$item['phone'],
                                                            'custom_fields' => $item['custom_fields']

                                                        ]); 
                                                @endphp
                                                <a href="" class="btn btn-edit showDetailsData" data-bs-toggle="modal" data-bs-target="#showDetails" data-json="{{ $json }}"><i class="fas fa-eye"></i></a>
                                                <button type="submit" class="btn btn-delete" onclick="deleteUser({{ $item['id'] }})"><i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $item['id']}}" action="{{route('student.destroy',$item['id'])}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Data Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="showDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-2">
                    <div class="row"> 
                        <div class="center"><img src="{{asset('profile.png')}}" class="rounded-circle profile-image" alt="..."></div>
                        <h6 class="mt-3"><i>Academic Information</i></h6>     
                        <table class="table table-bordered table-striped table-sm profile-table" id="profileData">
                        <tbody>
                            <tr>
                                <th width="30%">Name <span class="float-right">:</span></th>
                                <td id="txtName"></td>
                            </tr>
                            <tr>
                                <th width="30%">Class <span class="float-right">:</span></th>
                                <td id="txtClass"></td>
                            </tr>
                            <tr>
                                <th width="30%">Phone <span class="float-right">:</span></th>
                                <td id="txtPhone"></td>
                            </tr>
                            <tr>
                                <th width="30%">Email <span class="float-right">:</span></th>
                                <td id="txtEmail"></td>
                            </tr>
                        </tbody>
                        </table>   
                        <h6><i>Others Information</i></h6>                       
                        <table class="table table-bordered table-striped table-sm profile-table">
                            <tbody id="appendData">

                            </tbody>
                        </table>                                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- close modal -->
@endsection
@push('admin-js')
<script>
  $(document).on("click",'.showDetailsData',function(){
    let record = $(this).data('json');
    $("#profileData").find('#txtName').text(record.name);
    $("#profileData").find('#txtClass').text(record.class);
    $("#profileData").find('#txtPhone').text(record.phone);
    $("#profileData").find('#txtEmail').text(record.email);
    $('#appendData').empty();

    var tbl = '';
    $.each(record.custom_fields, function(index, value) {
        console.log('dataa',value.title)
        tbl+='<tr>';
            tbl+='<th width="30%">'+value.title+'<span class="float-right">:</span></th>';
            tbl+='<td>'+value.value+'</td>';
        tbl+='</tr>';
    });

    $('#appendData').append(tbl);
  });

</script>                                                        
    <script src="{{ asset('admin/js/sweetalert2.all.js') }}"></script>
    <script>

        function deleteUser(id) {
            swal({
                title: 'Are you sure?',
                text: "You want to Delete this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
