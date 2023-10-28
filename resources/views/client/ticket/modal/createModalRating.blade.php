<form action="#" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreateRating" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Đánh Giá Của Bạn</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $listRatingText = [
                        1 => 'Không thích',
                        2 => 'Tạm được',
                        3 => 'Bình thường',
                        4 => 'Tốt',
                        5 => 'Rất tốt',
                    ]; ?>
                    <span class="list_start">
                        <span>Chọn đánh giá: </span>
                        @for($i = 1; $i<=5; $i++) <i class="fa fa-star" data-key="{{$i}}"></i>
                            @endfor
                            <span class="list_text"></span>
                    </span>
                    <input type="hidden" value="" class="number_rating">
                    <input type="hidden" value="" class="iddc">
                    <div class="mt-3">Nhận xét:</div>
                    <textarea name="content" class="form-control content" id="content" id="" cols="30" rows="4"></textarea>
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{ __('Trở về') }}</button>
                        <button type="button" class="btn btn-primary rating_bus">{{ __('Gửi đánh giá') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>