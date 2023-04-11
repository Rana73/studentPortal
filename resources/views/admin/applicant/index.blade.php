@extends('layouts.admin')
@section('title', 'Application List')
@section('admin-content')
<div class="container">
    <div class="heading-title p-2 my-2">
        <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{ route('dashboard') }}">Home</a> > Application List</span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-1"><span style="font-size: 14px; font-weight: 600; color: #0e2c96;">Search Form</span></div>
                <div class="card-body table-card-body my-table">
                    <form id="searchForm" class="searchForm">

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <label for="">Applicant's Name</label>
                                </div>
                                <div class="col-md-8 col-12">
                                <input class="form-control form-control-sm custom-form-control" list="nameOption" type="text" placeholder="Applicant's Name" name="name" id="name" autocomplete="off">
                                <datalist id="nameOption">
                                    @foreach($data["name"] as $item)
                                    <option value="{{$item->name}}">
                                    @endforeach
                                </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <label for="">Email Address</label>
                                </div>
                                <div class="col-md-8 col-12">
                                <input class="form-control form-control-sm custom-form-control" list="emailOption" type="email" placeholder="Email Address" name="email" id="email" autocomplete="off">
                                <datalist id="emailOption">
                                    @foreach($data["name"] as $item)
                                    <option value="{{$item->email}}">
                                    @endforeach
                                </datalist>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="row">
                            <div class="col-4">
                            <label for="" class="form-label">Division</label><span class="float-end">:</span>
                            </div>
                            <div class="col-8">
                            <select class="form-select custom-form-control" name="division" id="division" onchange="fetchDistricts(this.value)">
                                <option value="" selected disabled>Select one</option>
                                @foreach($data["division"] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 col-12">
                            <div class="row">
                                <div class="col-4">
                                <label for="" class="form-label">District</label><span class="float-end">:</span>
                                </div>
                                <div class="col-8">
                                <select class="form-select custom-form-control" name="district" id="district" onchange="fetchUpazilas(this.value)">
                                <option value="" selected disabled>Select one</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="row">
                                <div class="col-4">
                                    <label for="" class="form-label">Upazila</label><span class="float-end">:</span>
                                </div>
                                <div class="col-8">
                                    <select class="form-select custom-form-control" name="upazila" id="upazila">
                                    <option selected disabled>Select one</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mt-md-0 mt-2">
                                <button type="submit" class="btn btn-sm btn-primary w-50">Search</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="min-height: 50vh">
        <div class="row">
            <div class="col-12 px-0" id="searcResult">

            </div>
        </div>
    </div>
@endsection
@push('admin-js')

<!-- District Fetch -->
<script>
    function fetchDistricts(id){

      $.ajax({
        url:'/fetch-districts/'+id,
        method: 'get',
        success:function(res){
          $('#district').html(res);
          let id = $("#district").val();
          fetchUpazilas(id);
        }
      })
    }
  </script>

  <!-- Upaila Fetch -->
  <script>
    function fetchUpazilas(id){

      $.ajax({
        url:'/fetch-upazilas/'+id,
        method: 'get',
        success:function(res){
          $('#upazila').html(res);
        }
      })
    }
  </script>
  <!-- ajax setup -->
  <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  </script>

  <!-- pagination -->
  <script src="{{ asset('admin/js/pagination.min.js') }}"></script>
  <!-- Submit Form Data -->
  <script>
    $(document).on('submit', '.searchForm', function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
          url:"{{route('search.applicant')}}",
          type:"post",
          dataType: "json",
          data:formData,
          cache: false,
          contentType: false,
          processData: false,
          success:function(res){
            console.log(res)
            var data = '<div class="card mt-3">';
                data+='<div class="card-header">';
                    data+='<div class="table-head text-left"><i class="fas fa-table me-1"></i>Application List</div>';
                    data+='</div>';
                    data+='<div class="card-body table-card-body my-table">';
                        data+='<div class="tab-content" id="myTabContent">';
                            data+='<div class="tab-pane fade show active table-responsive" id="pending" role="tabpanel" aria-labelledby="home-tab">';
                                data+='<table class="table table-sm ">';
                                    data+='<thead class="text-center bg-light">';
                                        data+='<tr>';
                                            data+='<th>SL</th>';
                                            data+='<th>Applicant Name</th>';
                                            data+='<th>Email Address</th>';
                                            data+='<th>Division</th>';
                                            data+='<th>District</th>';
                                            data+='<th>Upazila/Thana</th>';
                                            data+='<th>Insert Date</th>';
                                            data+='<th>Action</th>';
                                        data+='</tr>';
                                    data+='</thead>';
                                    data+='<tbody>';
                                    $.each(res, function(key,value){
                                        data+='<tr>';
                                             data+='<td class="text-center">'+ ++key+'</td>';
                                            data+='<td class="text-center">'+value.name+'</td>';
                                            data+='<td class="text-center">'+value.email+'</td>';
                                            data+='<td class="text-right">'+value.division.name+'</td>';
                                            data+='<td class="text-center">'+value.district.name+'</td>';
                                            data+='<td class="text-center">'+value.upazila.name+'</td>';
                                            data+='<td class="text-center">'+value.created_at.substr(0, 10)+'</td>';
                                            data+='<td class="text-center"><a href="edit-application/'+value.id+'"class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a></td>';
                                        data+='</tr>';
                                    })
                                    if(res == ''){
                                        data+='<tr>';
                                            data+='<td class="text-center text-danger" colspan="7">Application Not Found</td>';
                                        data+='</tr>';
                                    }
                                    data+='</tbody>';
                                data+='</table>';
                            data+='</div>';
                        data+='</div>';
                    data+='</div>';
                data+='</div>';
                // $('#demo').pagination({
                //     dataSource: res,
                //     callback: function(data, pagination) {
                //         // template method of yourself
                //         var html = template(data);
                //         dataContainer.html(html);
                //     }
                // })
                $("#searcResult").html(data);

          }
      });
        })
  </script>
@endpush


