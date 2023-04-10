@extends('layouts.website')
@section('title','Add Student Form')
@section('website-content')

<!-- Registration Form -->
  <section class="mt-md-5 mt-2">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card custom-card w-100 mb-2">
              <div class="card-body">
                <div class="my-2">
                    <div class="form-title">
                      Student's Information Form
                    </div>
                </div>
              </div>
            </div>

            <!-- form card-->
            <div class="card custom-card w-100 mb-2">
              <div class="card-body">
                  <form id="registrationSave" class="registrationSave" >
                    <!-- First Row -->
                    <div class="row">
                      <div class="col-md-6 col-12">
                          <div class="row">
                              <div class="col-3 align-self-center">
                                <label for="" class="form-label">Class</label>
                            </div>
                            <div class="col-9">
                                <input class="form-control form-control-sm custom-form-control" type="text" placeholder="Type Class" name="class" id="class">
                                <strong><span class="text-danger" id="classError"></span></strong>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="row">
                          <div class="col-3 align-self-center">
                            <label for="" class="form-label">Name</label>
                          </div>
                          <div class="col-9">
                              <input class="form-control form-control-sm custom-form-control" type="text" placeholder="Type Name " name="name" id="name">
                              <strong><span class="text-danger" id="nameError"></span></strong>
                          </div>
                        </div>
                      </div>                     
                    </div>
                    <!-- Second Row -->
                    <div class="row mt-1">
                      <div class="col-md-6 col-12">
                          <div class="row">
                              <div class="col-3 align-self-center">
                              <label for="" class="form-label">Email</label>
                            </div>
                            <div class="col-9">
                              <input class="form-control form-control-sm custom-form-control" type="email" placeholder="Type Email" name="email" id="email">
                              <strong><span class="text-danger" id="emailError"></span></strong>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="row">
                          <div class="col-3 align-self-center">
                          <label for="" class="form-label">Status</label>
                          </div>
                          <div class="col-9">
                            <select class="form-control form-control-sm custom-form-control" name="status" id="status">
                              <option value="unconfirmed" selected>Unconfirmed</option>
                              <option value="admitted">Admitted</option>
                              <option value="terminated">Terminated</option>
                            </select>
                            <strong><span class="text-danger" id="statusError"></span></strong>
                          </div>
                        </div>
                      </div>                     
                    </div>

                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="py-1 text-center title-section">
                              Add Custom Field
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                      <div class="col-12">
                          <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary  px-5">Submit</button>
                          </div>
                      </div>
                    </div>

                  </form>
              </div>
            </div>
            <!-- form card close -->
            <div class="card custom-card w-100 mb-2">
              <div class="card-body py-2">
                <div class="text-center">Design & Developed By: <a href="https://ranamiah.ntsoftwareltd.com/" target="_blank" class="">Md Rana Miah</a></div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
<!-- Close Registration Form -->
@endsection

@push('website-js')
  <!-- ajax setup -->
  <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  </script>

  <!-- Submit Form Data -->
  <script>
    $(document).on('submit', '.registrationSave', function(e){
      e.preventDefault();

      let formData = new FormData(this);
      $.ajax({
          url:"{{route('student.store')}}",
          type:"post",
          dataType: "json",
          data:formData,
          cache: false,
          contentType: false,
          processData: false,
          success:function(res){
              alert(res.message);
              if(res.message == "Successfully Inserted!"){
                $('#registrationSave').trigger('reset');
                $('#district').val('');
                $('#upazila').val('');
              }
          }
      });
        })
  </script>

@endpush
