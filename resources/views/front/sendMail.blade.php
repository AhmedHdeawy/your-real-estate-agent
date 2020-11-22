<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        <h5> {{ __('lang.sendMailToAgent') }} </h5>
        <div class="row my-3">
            <div class="col-12 col-md-4">
                <img src="{{ $property->images->first()->image_url }}" class="img-fluid img-thumbnail">
            </div>
            <div class="col-12 col-md-8">
                <h6> {{ $property->title }} </h6>
                <p class="text-danger"> {{ $property->price }} {{ __('lang.aed') }}  </p>
                <p> {{ __('lang.agent_name') }} : {{ $property->agent_name }}   </p>
            </div>
        </div>
        <div class="row">
            <form method="POST" action="{{ route('property.sendMailToAgent') }}" id="sendMailToAgent">
                <div class="row">
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    @csrf
                    <div class="col-12 my-1">
                        <textarea class="form-control" name="message" rows="3" required>{{ __('lang.mailMessage') }}</textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 my-1">
                        <input type="text" class="form-control" name="name" placeholder="{{ __('lang.name') }}"
                            value="{{ auth()->check() ? auth()->user()->name : '' }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 my-1">
                        <input type="email" class="form-control" name="email" placeholder="{{ __('lang.email') }}" required
                            value="{{ auth()->check() ? auth()->user()->email : '' }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 my-1">
                        <input type="phone" class="form-control" name="phone" placeholder="{{ __('lang.phone') }}" required
                            value="{{ auth()->check() ? auth()->user()->phone : '' }}">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{ __('lang.cancel') }} </button>
        <button type="submit" class="btn btn-theme"> {{ __('lang.send') }} </button>
        </form>
      </div>
    </div>
  </div>
</div>
