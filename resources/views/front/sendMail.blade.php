<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5> {{ __('lang.sendMailToAgent') }} </h5>
        <div class="row">
            <div class="col-12 col-md-4">
                <img src="{{ $property->images->first()->image_url }}" class="img-fluid img-thumbnail">
            </div>
            <div class="col-12 col-md-8">
                <h5> {{ $property->title }} </h5>
                <p> {{ $property->price }} {{ __('lang.aed') }}  </p>
                <p> {{ __('lang.agent_name') }} {{ $property->agent_email }}   </p>
            </div>
        </div>
        <div class="row">
            <form>
                <div class="form-group">
                    <textarea class="form-control" name="body"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                </div>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{ __('lang.cancel') }} </button>
        <button type="button" class="btn btn-primary"> {{ __('lang.send') }} </button>
      </div>
    </div>
  </div>
</div>
