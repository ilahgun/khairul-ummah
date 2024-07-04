@extends('admin.index')
@section('content')
<section class="section">

    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-3 text-capitalize font-weight-bold">Jumlah Anak Asuh</p>
                  <h5 class="font-weight-bolder mb-0">
                        {{ $row_anakasuh }}
                  </h5> 
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-3 text-capitalize font-weight-bold">Jumlah Donatur</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $row_donatur }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-3 text-capitalize font-weight-bold">Jumlah Pengurus</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $row_pengurus}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-3 text-capitalize font-weight-bold">Total Donasi</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $row_total->total_donasi}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    <div class="row">

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rekapitulasi Gender Anak Asuh</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>
              var lbl2 = [@foreach($ar_gender as $gender) '{{$gender->gender}}', @endforeach];
              var jml2 = [@foreach($ar_gender as $gender) {{$gender->jumlah}}, @endforeach];
              
              //{{--  {$harta->kekayaan}} tidak usah petik karena tipenya integer datnya  --}}
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                      labels:lbl2,
                      datasets: [{

                        label: 'My First datasets',
                        data:jml2,
                        backgroundColor: [
                          'rgb(23, 250, 4)',
                          'rgb(216, 250, 4)',
                          'rgb(4, 250, 142 )'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Pie CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rekapitulasi Pendidikan Anak Asuh</h5>

              <!-- Doughnut Chart -->
              <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
              <script>

              var label3 = [@foreach($ar_pendidikan as $didik) '{{$didik->pendidikan}}', @endforeach];
              var jml3 = [@foreach($ar_pendidikan as $didik) {{$didik->jumlah}}, @endforeach];
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#doughnutChart'), {
                    type: 'doughnut',
                    data: {
                      labels: label3,
                      datasets: [{
                        label: 'My First Dataset',
                        data: jml3,
                        backgroundColor: [
                          'rgb(6, 127, 44  )',
                          'rgb250, 153, 4 )',
                          'rgb(4, 75, 250 )',
                          'rgb(4, 86, 250 )',
                          'rgb(250, 56, 4 )',
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Doughnut CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rekapitulasi Donasi</h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px;"></canvas>
              <script>
              //ambil data nama dan kekayaan pegawai dari fungsi indeks
              var lbl = [@foreach($ar_donasi as $dana) '{{$dana->tgl_donasi}}', @endforeach];
              var dana = [@foreach($ar_donasi as $dana) {{$dana->jml_donasi}}, @endforeach];
              //{{--  {$harta->kekayaan}} tidak usah petik karena tipenya integer datnya  --}}
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      //label: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        labels: lbl,
                        datasets:[{

                        //label: 'Harta Kekayaan Pegawai',
                        //data: [65, 59, 80, 81, 56, 55, 40],
                        data:dana,
                        backgroundColor: [
                          'rgba(8, 240, 81, 0.5)',
                          'rgba(5, 176, 59, 0.5)',
                          'rgba(3, 146, 48, 0.5)',
                          'rgba(1, 119, 38, 0.5)',
                          'rgba(1, 87, 28, 0.25',
                          'rgba(1, 69, 23, 0.5)',
                          'rgba(1, 52, 17, 0.5)'
                        ],
                        borderColor: [
                          'rgba(8, 240, 81)',
                          'rgba(5, 176, 59)',
                          'rgba(3, 146, 48)',
                          'rgba(1, 119, 38)',
                          'rgba(1, 87, 28)',
                          'rgba(1, 69, 23)',
                          'rgba(1, 52, 17)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
@endsection