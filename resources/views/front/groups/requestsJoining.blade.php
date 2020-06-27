<li class='clearfix alert alert-primary' style="cursor: pointer" data-target="#reviewAnswers_{{ $notify->id }}" data-toggle="modal">
    <p class="d-inline mb-0 float-right font-weight-normal">
        {{ __('lang.userRequestJoinToGroup', [ 'user'  =>  $notify->data['user_name'], 'group' => $notify->data['group_name']]) }}
    </p>
    <span class="float-left">{{ $notify->created_at->diffForHumans() }}</span>
</li>

<!-- Modal -->
<div class="modal fade" id="reviewAnswers_{{ $notify->id }}" tabindex="-1" role="dialog"
    aria-labelledby="reviewAnswers_{{ $notify->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('lang.reviewAnswers') }}
                </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($notify->data['userAnswers'] as $answer)

                    <div class="col-12">
                        <div class="alert alert-secondary" role="alert">

                            <h6 class="color-rbzgo">{{ $answer['title'] }}</h6>
                            <div>
                                <i class="fas fa-arrow-circle-left"></i>
                                <span class="text-success mx-3">{{ $answer['answer'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('handelJoinRequests') }}" method="POST">
                    @csrf
                    <input type="hidden" name="notify_id" value="{{ $notify->id }}">
                    <input type="hidden" name="user_id" value="{{ $notify->data['user_id'] }}">
                    <input type="hidden" name="group_id" value="{{ $notify->data['group_id'] }}">
                    <input type="hidden" name="status" value="accept">
                    <button type="submit" class="btn btn-success">
                        <span class="text-white">{{ __('lang.accept') }}</span>
                    </button>
                </form>

                <form action="{{ route('handelJoinRequests') }}" method="POST">
                    @csrf
                    <input type="hidden" name="notify_id" value="{{ $notify->id }}">
                    <input type="hidden" name="user_id" value="{{ $notify->data['user_id'] }}">
                    <input type="hidden" name="group_id" value="{{ $notify->data['group_id'] }}">
                    <input type="hidden" name="status" value="denied">
                    <button type="submit" class="btn btn-danger">
                        <span class="text-white">{{ __('lang.denied') }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
