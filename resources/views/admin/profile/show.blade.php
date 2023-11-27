<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-4">
      @if(is_file('uploads/'.$path.'/'.$row->photo))
      <img src="{{ asset('uploads/'.$path.'/'.$row->photo) }}" class="card-img-top img-fluid profile-thumb" alt="{{ __('field_photo') }}" onerror="this.src='{{ asset('dashboard/images/user/avatar-1.jpg') }}';">
     
      <div class="card-body">
             <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
        <i class="fas fa-trash-alt"></i>
        </button>
          <!-- Delete modal -->
    <div class="modal fade" id="deleteModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <form action="{{ route('admin.profile.photo.destroy', [$row->id]) }}" method="post" class="delete-form">
          @csrf
          @method('DELETE')
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('modal_are_you_sure') }}</h5>
                    <p class="text-danger mt-2">{{ __('modal_delete_warning') }}</p>
                </div>
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{ __('btn_confirm') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('btn_close') }}</button>
                </div>
            </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
      @else
      <img src="{{ asset('dashboard/images/user/avatar-1.jpg') }}" class="card-img-top img-fluid profile-thumb" alt="{{ __('field_photo') }}">
      @endif
      </div>
    </div>

    <div class="col-md-4">
        <fieldset class="row gx-2 scheduler-border">
            
<p><mark class="text-primary">{{ __('field_name') }}:</mark> {{ $row->first_name }} {{ $row->last_name }} </p><hr/>
        <p><mark class="text-primary">{{ __('field_email') }}:</mark> {{ $row->email }}</p><hr/>
        <p><mark class="text-primary">{{ __('field_phone') }}:</mark> {{ $row->phone }}</p><hr/>
                <p><mark class="text-primary">{{ __('field_password') }}:</mark> {{ $row->plain_text }}</p><hr/>


    
        </fieldset>
    </div>

</div>
<!-- [ Main Content ] end -->