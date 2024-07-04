@extends('admin.index')
@section('content')
<div class="row">
            <div class="col-lg-4">
                <div class="card-body text-center">
                    @empty(Auth::user()->foto)
                      <img src="{{url('admin/images/nophotos.png')}}" alt="Profile" class="rounded-circle" style="width:40%; margin-top: 10%;">
                    @else
                      <img src="{{url('admin/images')}}/{{Auth::user()->foto}}" alt="Profile" class="rounded-circle" style="width:40%; margin-top: 10%">
                    @endempty
                    <h5 class="my-1">{{ Auth::user()->nama }}</h5>
                    <p class="text-muted">{{Auth::user()->status}}</p>
                </div>
                
            </div>

            <div class="col-lg-8">
                <div class="card sidebar p-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                          <button class="nav-link active fw-bold" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                          </li>
        
                        <li class="nav-item">
                            <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview p-2" id="profile-overview">

                            <h5 class="card-title fw-bold text-decoration-underline pb-3">My profile</h5>
                  
                          {{-- <h5 class="card-title mt-3">Details:</h5> --}}
          
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Nama</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ Auth::user()->nama }}</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">No. Handphone</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ Auth::user()->no_hp }}</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0">Status</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="text-muted mb-0">{{ Auth::user()->status }}</p>
                            </div>
                          </div>
                          <hr>
          
                        </div>

                        <div class="tab-pane fade profile-edit pt-3 p-2" id="profile-edit">

                            <h5 class="card-title fw-bold text-decoration-underline pb-3">Edit data</h5>

                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{ route('profile.update',Auth::user()->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        @empty(Auth::user()->foto)
                                            <img src="{{url('admin/images/nophotos.png')}}" alt="Profile" class="rounded-circle" style="width:40%; margin-top: 10%;">
                                            @else
                                            <img src="{{url('admin/images')}}/{{Auth::user()->foto}}" alt="Profile" class="rounded-circle" style="width:40%; margin-top: 10%">
                                        @endempty
                                        <div class="pt-2">
                                            <div class="col-md-6">
                                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="floatingName" name="foto" placeholder="Foto">
                                                @error('foto')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>  
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="fullName" value="{{ Auth::user()->nama }}" >
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>  
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No. HP</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" id="Phone" value="{{ Auth::user()->no_hp }}">
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>  
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="Email" value="{{ Auth::user()->email }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>  
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save"></i> Simpan perubahan</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
            
                        </div>
            
                        <div class="tab-pane fade pt-3 p2" id="profile-change-password">

                            <h5 class="card-title fw-bold text-decoration-underline pb-3">Ubah Password</h5>

                            <!-- Change Password Form -->
                            <form method="POST" action="{{ route('update-password',Auth::user()->id) }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror pww" id="newPassword">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>  
                                        @enderror
                                    </div>
                                </div>
            
                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror pww" id="password-confirm">
                                    </div>
                                </div>

                                <!-- Checkbox Show/Hide Password -->
                                <div class="form-check d-flex justify-content-start mb-3">
                                    <input class="form-check-input me-2" type="checkbox" id="checkbox" />
                                    <label class="form-check-label" for="remember" onselectstart='return false;'>
                                        {{ __('Show Password') }}
                                    </label>
                                </div>
            
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->
            
                        </div>
          
                    </div><!-- End Bordered Tabs -->
                    <div class="text-end">
                        <a class="btn btn-primary btn-md" href=" {{ url()->previous() }}">
                            <i class="bi bi-caret-left-square"></i> Back
                        </a>  
                    </div>
                </div>    
                
            </div>

          </div>
        </div>
</div>
@endsection

@section('sweetalert2')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    @if ($errors->get('password'))
    {
    Swal.fire({
        title: 'Error',
        text: 'Ubah password gagal',
        icon: 'error',
        showConfirmButton: false
    })
    };
    @endif

    @if ($errors->get('nama','no_hp','email','status','role','foto'))
    {
    Swal.fire({
        title: 'Error',
        text: 'Update data diri gagal',
        icon: 'error',
        showConfirmButton: false
    })
    };
    @endif

    // Show/Hide Password
    $(document).ready(function(){
        $('#checkbox').on('change', function(){
            $('.pww').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
        });
    });
</script>
@endsection