@if(auth()->user()->type == 1)
    <div class="form-group col-lg-3 col-md-6">
        <label>الدوله<span class="text-danger">*</span></label>
        <select name="country_id" class="form-control selectpicker"
                id="country" required="required" data-live-search="true">
            <option value="0">الكل</option>
            @foreach(auth()->user()->countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
        </select>
    </div>
@endif

@if(auth()->user()->type == 1 || auth()->user()->type == 2)
    <div class="form-group col-lg-3 col-md-6">
        <label>المحافظه<span class="text-danger">*</span></label>
        <select name="state_id" class="form-control selectpicker" id="state"
                required="required" data-live-search="true">
            <option value="0">الكل</option>
            @foreach(auth()->user()->states as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
            @endforeach
        </select>
    </div>
@endif

@if(auth()->user()->type == 1 ||auth()->user()->type == 2 || auth()->user()->type == 3)
    <div class="form-group col-lg-3 col-md-6">
        <label>المدينه<span class="text-danger">*</span></label>
        <select name="city_id" class="form-control selectpicker"
                id="city" required="required" data-live-search="true">
            <option value="0">الكل</option>
            @foreach(auth()->user()->cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>
    </div>
@endif

@if(auth()->user()->type == 1 ||auth()->user()->type == 2 || auth()->user()->type == 3 || auth()->user()->type == 4)
    <div class="form-group col-lg-3 col-md-6">
        <label>المنطقه<span class="text-danger">*</span></label>
        <select name="zone_id" class="form-control selectpicker" id="zone" required="required"
                data-live-search="true">
            <option value="0">الكل</option>
            @foreach(auth()->user()->zones as $zone)
                <option value="{{$zone->id}}">{{$zone->name}}</option>
            @endforeach
        </select>
    </div>
@endif


@props([
    'countrySelector' => '#country',
    'stateSelector' => '#state',
    'citySelector' => '#city',
    'zoneSelector' => '#zone',

    'statesUrl' => url('getstatesemployee'),
    'citiesUrl' => url('getcitiesemployee'),
    'zonesUrl' => url('getzonesemployee'),
])

<script>
    $(function () {
        const locationConfig = {
            countrySelector: @json($countrySelector),
            stateSelector: @json($stateSelector),
            citySelector: @json($citySelector),
            zoneSelector: @json($zoneSelector),

            statesUrl: @json($statesUrl),
            citiesUrl: @json($citiesUrl),
            zonesUrl: @json($zonesUrl)
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function resetLocationSelect(selector) {
            const select = $(selector);

            if (!select.length) {
                return;
            }

            select
                .empty()
                .append('<option value="0">الكل</option>')
                .val('0');

            select.selectpicker('refresh');
        }

        function fillLocationSelect(selector, options) {
            const select = $(selector);

            if (!select.length) {
                return;
            }

            select.empty();

            /*
             * نضيف "الكل" فقط إذا لم يكن موجودًا
             * داخل البيانات القادمة من الـ API.
             */
            if (
                typeof options !== 'string' ||
                !options.includes('value="0"')
            ) {
                select.append('<option value="0">الكل</option>');
            }

            select.append(options);
            select.val('0');
            select.selectpicker('refresh');
        }

        function loadLocationOptions(url, targetSelector) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',

                success: function (result) {
                    if (result.status === true) {
                        fillLocationSelect(
                            targetSelector,
                            result.data
                        );
                    }
                },

                error: function (xhr) {
                    console.error(
                        'حدث خطأ أثناء تحميل بيانات الموقع',
                        xhr
                    );

                    resetLocationSelect(targetSelector);
                }
            });
        }

        /*
         * عند تغيير الدولة:
         * تصفير المحافظة والمدينة والمنطقة.
         */
        $(document)
            .off(
                'change.locationCascade',
                locationConfig.countrySelector
            )
            .on(
                'change.locationCascade',
                locationConfig.countrySelector,
                function () {
                    const countryId = Number($(this).val() || 0);

                    resetLocationSelect(
                        locationConfig.stateSelector
                    );

                    resetLocationSelect(
                        locationConfig.citySelector
                    );

                    resetLocationSelect(
                        locationConfig.zoneSelector
                    );

                    if (countryId === 0) {
                        return;
                    }

                    loadLocationOptions(
                        `${locationConfig.statesUrl}/${countryId}`,
                        locationConfig.stateSelector
                    );
                }
            );

        /*
         * عند تغيير المحافظة:
         * تصفير المدينة والمنطقة.
         */
        $(document)
            .off(
                'change.locationCascade',
                locationConfig.stateSelector
            )
            .on(
                'change.locationCascade',
                locationConfig.stateSelector,
                function () {
                    const stateId = Number($(this).val() || 0);

                    resetLocationSelect(
                        locationConfig.citySelector
                    );

                    resetLocationSelect(
                        locationConfig.zoneSelector
                    );

                    if (stateId === 0) {
                        return;
                    }

                    loadLocationOptions(
                        `${locationConfig.citiesUrl}/${stateId}`,
                        locationConfig.citySelector
                    );
                }
            );

        /*
         * عند تغيير المدينة:
         * تصفير المنطقة.
         */
        $(document)
            .off(
                'change.locationCascade',
                locationConfig.citySelector
            )
            .on(
                'change.locationCascade',
                locationConfig.citySelector,
                function () {
                    const cityId = Number($(this).val() || 0);

                    resetLocationSelect(
                        locationConfig.zoneSelector
                    );

                    if (cityId === 0) {
                        return;
                    }

                    loadLocationOptions(
                        `${locationConfig.zonesUrl}/${cityId}`,
                        locationConfig.zoneSelector
                    );
                }
            );
    });
</script>
