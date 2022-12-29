<div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> النوع
            <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select wire:model="selectType" name="type" required="required" class="form-control col-md-7 col-xs-12">
                <option value="">اختر النوع</option>
                <option value="1">ايجار</option>
                <option value="2">بيع</option>
            </select>
        </div>
    </div>

    @if ($selectType == 1)
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> نوع الايجار
                <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select wire:model="rental_type"  name="rental_type" required="required" class="form-control col-md-7 col-xs-12">
                    <option value="">اختر النوع</option>
                    <option value="1">ايجار عادي</option>
                    <option value="2">ايجار مفروش</option>
                </select>
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> السعر
            <span class="required"></span>
        </label>
        <div class="col-md-4 col-sm-4 col-xs-6">
            <input type="number" wire:model="price" name="price" id="price"
                class="form-control col-md-7 col-xs-12" value="">
        </div>
        @if ($selectType == 1)

        <div class="col-md-2 col-sm-2 col-xs-6">
            <select wire:model="rental" name="rental" required class="form-control col-md-7 col-xs-12">
                <option value=""> حدد المدة</option>
                <option value="monthly">شهريا</option>
                <option value="yearly">سنويا</option>
                <option value="daily">يوميا</option>
            </select>
        </div>
        @endif

    </div>
</div>
