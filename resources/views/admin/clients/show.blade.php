    <!-- Show modal content -->
    <div id="showModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ __('school') }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- Details View Start -->
                    <ul class="nav nav-pills mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="profile_info-{{ $row->id }}-tab" data-bs-toggle="tab" href="#profile_info-{{ $row->id }}" role="tab" aria-controls="profile_info-{{ $row->id }}" aria-selected="true">{{ __('school') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="educational_info-{{ $row->id }}-tab" data-bs-toggle="tab" href="#educational_info-{{ $row->id }}" role="tab" aria-controls="educational_info-{{ $row->id }}" aria-selected="false">{{ __('Student List') }}</a>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link text-uppercase" id="payroll_details-{{ $row->id }}-tab" data-bs-toggle="tab" href="#payroll_details-{{ $row->id }}" role="tab" aria-controls="payroll_details-{{ $row->id }}" aria-selected="false">{{ __('teacher') }}</a>-->
                        <!--</li>-->
                       
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile_info-{{ $row->id }}" role="tabpanel" aria-labelledby="profile_info-{{ $row->id }}-tab">
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="row gx-2 scheduler-border">
                                    <p><mark class="text-primary">{{ __('field_staff_id') }}:</mark> {{ $row->id }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_name') }}:</mark> {{ $row->first_name }} {{ $row->last_name }}</p><hr/>

                                    <p><mark class="text-primary">{{ __('field_district') }}:</mark> 
                                        {{ $row->district->title ?? '' }}
                                    </p><hr/>
                                    <p><mark class="text-primary">المرحلة الدراسية:</mark> 
                                        {{ $row->province->title ?? '' }}
                                    </p><hr/>


                                   <p><mark class="text-primary">
                                       عدد الطلاب :</mark> 
                                        {{  App\User::where('user_id',auth()->user()->id)->where('type','4')->count() }}
                                    </p><hr/>

                                    <p><mark class="text-primary">{{ __('field_gender') }}:</mark> 
                                        @if( $row->gender == 1 )
                                        {{ __('gender_male') }}
                                        @elseif( $row->gender == 2 )
                                        {{ __('gender_female') }}
                                        @elseif( $row->gender == 3 )
                                        {{ __('gender_other') }}
                                        @endif
                                    </p><hr/>

                                    </fieldset>
                                     <fieldset class="row gx-2 scheduler-border">
                                    <p><mark class="text-primary">{{ __('field_email') }}:</mark> {{ $row->email }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_password') }}:</mark> {{ $row->plain_text }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_phone') }}:</mark> {{ $row->phone }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_address') }}:</mark> {{ $row->address }}</p><hr/>

                                    </fieldset>

                                </div>
                                <div class="col-md-6">
                                   
                                    <fieldset class="row gx-2 scheduler-border">
                                    <p><mark class="text-primary">{{ __('field_teacher_email') }}:</mark> {{ optional($row->teacher)->email }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_teacher_password') }}:</mark> {{ optional($row->teacher)->plain_text }}</p><hr/>

                                    </fieldset>
                                    
                                     <fieldset class="row gx-2 scheduler-border">
                                    <p><mark class="text-primary">{{ __('field_admin_email') }}:</mark> {{ optional($row->admin)->email }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_admin_password') }}:</mark> {{ optional($row->admin)->plain_text }}</p><hr/>

                                    </fieldset>
                                  
                                </div>
                                
                                
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="educational_info-{{ $row->id }}" role="tabpanel" aria-labelledby="educational_info-{{ $row->id }}-tab">
                        <div class="">
                            <fieldset class="scheduler-border">
                            <div class="row">
                                <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_name') }}</th>
                                       
                                        <th>{{ __('field_email') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $row->students as $key => $row )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        
                                        <td>{{ $row->student->first_name }} </td>
                                     
                                        <td>
                                           {{ $row->student->email }}
                                        </td>
                                       
                                       
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                            </div>
                            </fieldset>
                        </div>
                        </div>
                       
                    </div>
                    <!-- Details View End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>