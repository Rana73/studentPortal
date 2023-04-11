@extends('layouts.admin')
@section('title', 'Update Application')
@push('admin-css')

@endpush
@section('admin-content')

<!-- Registration Form -->
  <section>
    <div class="container">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{ route('dashboard') }}">Home</a> > Update Applicant's Info </span>
        </div>
      <div class="row justify-content-center mt-md-5 mt-2">
        <div class="col-md-10 col-12">

            <div class="card custom-card w-100 mb-2" style="background-color: #6C78AF">
              <div class="card-body py-2">
                <div class="text-center text-white fw-bolder">Update Applicant's Information</div>
              </div>
            </div>
            <!-- form card-->
            <div class="card custom-card w-100 mb-2">
              <div class="card-body">
                  <form id="registrationUpdate" class="registrationUpdate" enctype="multipart/form-data">

                    <div class="row">
                      <div class="col-md-4 col-12 align-self-center">
                          <label for="" class="form-label">Applicant's Name </label>
                      </div>
                      <div class="col-md-8 col-12">
                          <input class="form-control custom-form-control" type="text" placeholder="Applicant's Name" name="name" id="name" value="{{$data['applicant']->name}}">
                          <input type="hidden" name="txtId" id="txtId" value="{{$data['applicant']->id}}">
                          <strong><span class="text-danger" id="nameError"></span></strong>
                      </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-md-4 col-12 align-self-center">
                          <label for="" class="form-label">Email Address</label>
                      </div>
                      <div class="col-md-8 col-12">
                          <input class="form-control custom-form-control" type="email" placeholder="Email Address" name="email" id="email" value="{{$data['applicant']->email}}">
                          <strong><span class="text-danger" id="emailError"></span></strong>
                      </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="py-1 text-center title-section">
                              Mailing Address
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 col-12">
                            <div class="row">
                              <div class="col-4">
                              <label for="" class="form-label">Division</label><span class="float-end">:</span>
                              </div>
                              <div class="col-8">
                              <select class="form-select custom-form-control" name="division" id="division" onchange="fetchDistricts(this.value)">
                                <option value="" selected disabled>Select one</option>
                                  @foreach($data["division"] as $item)
                                  <option value="{{ $item->id }}" {{$data['applicant']->division_id == $item->id ? 'selected':''}}>{{ $item->name }}</option>
                                  @endforeach
                              </select>
                              <strong><span class="text-danger" id="divisionError"></span></strong>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="row">
                              <div class="col-4">
                              <label for="" class="form-label">District</label><span class="float-end">:</span>
                              </div>
                              <div class="col-8">
                              <select class="form-select custom-form-control" name="district" id="district" onchange="fetchUpazilas(this.value)">
                                <option value="" selected disabled>Select one</option>
                                @foreach($data["district"] as $item)
                                  <option value="{{ $item->id }}" {{$data['applicant']->district_id == $item->id ? 'selected':''}}>{{ $item->name }}</option>
                                  @endforeach
                              </select>
                              <strong><span class="text-danger" id="districtError"></span></strong>
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
                                @foreach($data["upazila"] as $item)
                                  <option value="{{ $item->id }}" {{$data['applicant']->upazila_id == $item->id ? 'selected':''}}>{{ $item->name }}</option>
                                  @endforeach
                              </select>
                              <strong><span class="text-danger" id="upazilaError"></span></strong>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-md-4 col-12 align-self-center">
                          <label for="" class="form-label">Address Details</label>
                      </div>
                      <div class="col-md-8 col-12">
                          <textarea class="form-control custom-form-control" rows="2" placeholder="Address here ..." name="address" id="address">{{$data['applicant']->address}}</textarea>
                          <strong><span class="text-danger" id="addressError"></span></strong>
                      </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-md-4 col-12 align-self-center">
                          <label for="" class="form-label">Language Proficiency</label>
                      </div>
                      <div class="col-md-8 col-12">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="bangla" value="1" name="bangla" {{$data['applicant']->bangla == 1 ? 'checked' : ''}}>
                          <label class="form-check-label" for="bangla">Bangla</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="english" value="2" name="english" {{$data['applicant']->english == 2 ? 'checked' : ''}}>
                          <label class="form-check-label" for="english">English</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="french" value="3" name="french" {{$data['applicant']->french == 3 ? 'checked' : ''}}>
                          <label class="form-check-label" for="french">French</label>
                        </div>
                        <strong><span class="text-danger" id="languageError"></span></strong>
                      </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="py-1 text-center title-section">
                              Educational Qualification
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th scope="col">Exam Name</th>
                                <th scope="col">University</th>
                                <th scope="col">Board</th>
                                <th scope="col">Result</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody id="copy_education">
                                @isset($data["applicant"]->education)
                                    @foreach ($data["applicant"]->education as $key => $eduItem)
                                    <tr id="tblprevedu{{ $eduItem->id }}">
                                        <th>
                                            <select class="form-select custom-form-control" name="exam[]" id="exam" required>
                                            <option value="" selected disabled>Select one</option>
                                            @foreach($data["exam"] as $item)
                                            <option value="{{$item->id}}" {{$eduItem->exam_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                            </select>
                                            <strong><span class="text-danger" id="examError"></span></strong>
                                        </th>
                                        <td>
                                            <select class="form-select custom-form-control" id="university" name="university[]" required>
                                            <option selected disabled>Select one</option>
                                            @foreach($data["university"] as $item)
                                            <option value="{{$item->id}}" {{$eduItem->university_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                            </select>
                                            <strong><span class="text-danger" id="universityError"></span></strong>
                                        </td>
                                        <td>
                                            <select class="form-select custom-form-control" name="board[]" id="board" required>
                                            <option selected disabled>Select one</option>
                                            @foreach($data["board"] as $item)
                                            <option value="{{$item->id}}" {{$eduItem->board_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                            </select>
                                            <strong><span class="text-danger" id="boardError"></span></strong>
                                        </td>
                                        <td>
                                        <input class="form-control custom-form-control" type="text" placeholder="Result" name="result[]" id="result" value="{{$eduItem->result}}" required>
                                        <strong><span class="text-danger" id="resultError"></span></strong>
                                        </td>
                                        <td>
                                            @if($key!= 0)
                                                <button type="button" class="btn btn-sm btn-delete" onclick="removePrevEducation({{ $eduItem->id }})"><i class="fas fa-trash-alt"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset

                              <tr>
                                <td colspan="5" class="text-end"> <button type="button" class="btn btn-sm btn-add add-education-info px-4"><i class="fas fa-plus"></i></button></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-md-4 col-12 align-self-center">
                          <label for="" class="form-label">Photo</label>
                      </div>
                      <div class="col-md-6 col-8">
                          <input class="form-control custom-form-control" type="file" name="image" id="image" onchange="readURL(this)">
                          <strong><span class="text-danger" id="imageError"></span></strong>
                          <small><i><strong>N.B:</strong>&nbsp; File Must be an (image)</i></small>
                      </div>
                      <div class="col-md-2 col-4">
                        <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="width: 130px;height: 100px; background: #3f4a49;">
                      </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-md-4 col-12 align-self-center">
                          <label for="" class="form-label">CV Attachment</label>
                      </div>
                      <div class="col-md-6 col-8">
                          <input class="form-control custom-form-control" type="file" name="cv" id="cv" onchange="readURLCV(this)">
                          <strong><span class="text-danger" id="cvError"></span></strong>
                          <small><i><strong>N.B:</strong>&nbsp; Attachment Must be (doc, pdf)</i></small>
                      </div>
                      <div class="col-md-2 col-4">
                        <iframe class="form-controlo img-thumbnail" src="#" id="previewCV"
                            style="width: 130px; height: 100px; background: #3f4a49;"></iframe>
                      </div>
                    </div>


                    <div class="row mt-1">
                      <div class="col-md-4 col-12">
                          <label for="" class="form-label">Training</label>
                      </div>
                      <div class="col-md-8 col-12">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="training" id="yes" value="1" {{$data["applicant"]->training == 1 ? 'checked' : ''}}>
                          <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="training" id="no" value="2" {{$data["applicant"]->training == 2 ? 'checked' : ''}}>
                          <label class="form-check-label" for="no">No</label>
                        </div>
                        <strong><span class="text-danger" id="trainingError"></span></strong>
                        <div class="row mt-4" id="trainingInfo" style="display: none">
                          <div class="col-12">
                            <div class="alert-success py-1" role="alert" style="border-radius: 3px;padding-left:5px">
                              <span><strong>Training Information</strong></span>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">Training Name</th>
                                    <th scope="col">Training Details</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody id="addTrainingInfo">

                                    @foreach($data["applicant"]->trainings as $key => $item)
                                    <tr id="tblprevtraining{{$item->id}}">
                                        <td>
                                          <input class="form-control custom-form-control" type="text" placeholder="Training Name" name="training_name[]" name="training_name" value="{{$item->name}}" required>
                                          <strong><span class="text-danger" id="trainingNameError"></span></strong>
                                        </td>
                                        <td>
                                          <input class="form-control custom-form-control" type="text" placeholder="Training Details" name="training_details[]" name="training_details" value="{{$item->details}}" required>
                                          <strong><span class="text-danger" id="trainingDetailsError"></span></strong>
                                        </td>
                                        <td>
                                            @if($key!= 0)
                                                <button type="button" class="btn btn-sm btn-delete" onclick="removePrevTraining({{$item->id}})"><i class="fas fa-trash-alt"></i></button>
                                            @endif
                                        </td>
                                      </tr>
                                    @endforeach


                                  <tr>
                                    <td colspan="3" class="text-end"><button type="button" class="btn btn-sm btn-add add-training-info px-4"><i class="fas fa-plus"></i></button></td>
                                  </tr>

                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                              <div class="float-end">
                                <button type="submit" class="btn btn-sm btn-primary  px-5">Update</button>
                              </div>
                          </div>
                        </div>

                      </div>
                    </div>

                  </form>
              </div>
            </div>
            <!-- form card close -->
        </div>
      </div>
    </div>
  </section>
<!-- Close Registration Form -->
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

  <!-- Training info hide and show -->

  <script>
    @if($data["applicant"]->training == 1)
    $("#trainingInfo").show();
    @endif
   $(function() {
   $("input[name='training']").click(function() {
      if ($("#yes").is(":checked")) {
        $("#trainingInfo").show();
      } else {
        $("#trainingInfo").hide();
      }
      });
    });
  </script>

  <!-- Add Educational and Remove Information -->
  <script>
    $(document).ready(function(){
    var count=1;
    $('.add-education-info').on('click', function(){
     count+=1;
     /*row-1*/
      var tbl = `<tr class="education-row" id="tbl${count}">`;
              tbl+=`<th>
                      <select class="form-select custom-form-control" name="exam[]" required>
                        <option value="" selected disabled>Select one</option>
                        @foreach($data["exam"] as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                  </th>`;
              tbl+=`<td>
                      <select class="form-select custom-form-control" name="university[]" required>
                        <option value="" selected disabled>Select one</option>
                        @foreach($data["university"] as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                    </td>`;
              tbl+=`<td>
                      <select class="form-select custom-form-control" name="board[]" required>
                        <option value="" selected disabled>Select one</option>
                        @foreach($data["board"] as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                    </td>`;
              tbl+=`<td>
                      <input class="form-control custom-form-control" name="result[]" type="text" placeholder="Result" required>
                    </td>`;
              tbl+=`<td>
                      <button type="button" class="btn btn-sm btn-delete remove_education"><i class="fas fa-trash-alt"></i></button>
                    </td>`;
      tbl+=`</tr>`;

            $('#copy_education').append(tbl);
        });

        /*remove row*/
        $(document).on("click", ".remove_education", function(){
            var id = $(this).closest('.education-row').attr('id');
            $("#"+id).remove();
        })
      });
  </script>

  <!-- remove prev education -->
  <script>
    function removePrevEducation(id){
      $("#tblprevedu"+id).remove();
    }
  </script>

  <!-- remove prev training -->
  <script>
    function removePrevTraining(id){
      $("#tblprevtraining"+id).remove();
    }
  </script>

  <!-- Add Training and Remove Information -->
  <script>
    $(document).ready(function(){
    var count=1;
    $('.add-training-info').on('click', function(){
     count+=1;
     /*row-1*/
      var tbl = `<tr class="training-row" id="tblt${count}">`;
              tbl+=`<td>
                      <input class="form-control custom-form-control" type="text" placeholder="Training Name" name="training_name[]" required>
                    </td>`;
              tbl+=`<td>
                      <input class="form-control custom-form-control" type="text" placeholder="Training Details" name="training_details[]" required>
                    </td>`;
              tbl+=`<td>
                      <button type="button" class="btn btn-sm btn-delete remove_training"><i class="fas fa-trash-alt"></i></button>
                    </td>`;
      tbl+=`</tr>`;

            $('#addTrainingInfo').append(tbl);
        });

        /*remove row*/
        $(document).on("click", ".remove_training", function(){
            var id = $(this).closest('.training-row').attr('id');
            $("#"+id).remove();
        })
      });
  </script>

  <!-- image preview -->
  <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(130);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    @if(!empty($data["applicant"]->image))
    document.getElementById("previewImage").src = "{{asset($data['applicant']->image)}}";
    @else
    document.getElementById("previewImage").src = "/noimage.png";
    @endif
  </script>
  <!-- cv preview -->
  <script>
    function readURLCV(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewCV')
                    .attr('src', e.target.result)
                    .width('100%');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    @if(!empty($data["applicant"]->image))
    document.getElementById("previewCV").src = "{{asset($data['applicant']->cv)}}";
    @else
    document.getElementById("previewCV").src = "/file.png";
    @endif
  </script>


  <!-- ajax setup -->
  <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  </script>
  <!-- jquery validation-->
  <script src="{{ asset('website/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('website/js/additional-method.js') }}"></script>
  <!-- script js -->
  <script src="{{ asset('admin/js/validate.js') }}"></script>
  <!-- Submit Form Data -->
  <script>
    $(document).on('submit', '.registrationUpdate', function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
          url:"{{route('applicant.update')}}",
          type:"post",
          dataType: "json",
          data:formData,
          cache: false,
          contentType: false,
          processData: false,
          success:function(res){
              alert(res.message);
              if(res.message == "Successfully Updated!"){
                window.location.href = "/applicant/application-list";
              }

              // $('#imagePreview').val('');
              // $('#previewImage').attr('src','/noimage.png');
              // // error messag hide
              // $('#titleError').text('');
              // $('#title').removeClass('is-invalid');
              // $('#short_details').removeClass('is-invalid');
              // $('#offerError').text('');
              // $('#offer_name').removeClass('is-invalid');
              // $('#offerlinkError').text('');
              // $('#offer_link').removeClass('is-invalid');
              // $('#imageError').text('');
              // $('#image').removeClass('is-invalid');
          }
          // error:function(data){
          //     $('#titleError').text(data.responseJSON.errors.title);
          //     if(data.responseJSON.errors.title){
          //         $('#title').addClass('is-invalid');
          //     }
          //     $('#offerError').text(data.responseJSON.errors.offer_name);
          //     if(data.responseJSON.errors.offer_name){
          //         $('#offer_name').addClass('is-invalid');
          //     }
          //     $('#offerlinkError').text(data.responseJSON.errors.offer_link);
          //     if(data.responseJSON.errors.offer_link){
          //         $('#offer_link').addClass('is-invalid');
          //     }
          //     $('#imageError').text(data.responseJSON.errors.image);
          //     if(data.responseJSON.errors.image){
          //         $('#image').addClass('is-invalid');
          //     }
          // }

      });
        })
  </script>

@endpush
