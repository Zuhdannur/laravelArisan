<div class="sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="https://via.placeholder.com/50x50" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">{{ Auth::user()->type }}</span>
									<span class="caret"></span>
								</span>
                    </a>
                    <div class="clearfix"></div>
                    
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ url('/profile') }}">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>
                <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#penerimaan">
                        <i class="fas fa-pen-square"></i>
                        <p>Pendapatan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="penerimaan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/pendapatan') }}">
                                    <span class="sub-item">Pendapatan Harian</span>
                                </a>
                            </li>
                            <li>
                                <a href="forms/formvalidation.html">
                                    <span class="sub-item">Laporan Pendapatan Bulanan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Pengeluaran</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/pengeluaran') }}">
                                    <span class="sub-item">Penegeluaran Harian</span>
                                </a>
                            </li>
                            @if($value != "pegawai")
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Laporan Penegeluaran Bulanan</span>
                                </a>
                            </li>
                                @endif
                        </ul>
                    </div>
                </li>
                @if($value != "pegawai")
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Kepegawaian</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/pegawai') }}">
                                    <span class="sub-item">Manage Pegawai</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('/jadwal') }}">
                        <i class="far fa-calendar-alt"></i>
                        <p>Jadwal</p>
                        <span class="badge badge-info">1</span>
                    </a>
                </li>
                @if($value != "pegawai")
                <li class="nav-item">
                    <a href="{{ url('/barang') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Barang</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                @endif
                <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                </li>
            </ul>
        </div>
    </div>
</div>