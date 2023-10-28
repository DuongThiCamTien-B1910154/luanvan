$(function () {
    $.datepicker.regional["vi-VN"] = {
        monthNames: [
            "Tháng một",
            "Tháng hai",
            "Tháng ba",
            "Tháng tư",
            "Tháng năm",
            "Tháng sáu",
            "Tháng bảy",
            "Tháng tám",
            "Tháng chín",
            "Tháng mười",
            "Tháng mười một",
            "Tháng mười hai",
        ],
        monthNamesShort: [
            "Th.Một",
            "Th.Hai",
            "Th.Ba",
            "Th.Tư",
            "Th.Năm",
            "Th.Sáu",
            "Th.Bảy",
            "Th.Tám",
            "Th.Chín",
            "Th.Mười",
            "Th.M Một",
            "Th.M Hai",
        ],
        dayNames: [
            "Chủ nhật",
            "Thứ hai",
            "Thứ ba",
            "Thứ tư",
            "Thứ năm",
            "Thứ sáu",
            "Thứ bảy",
        ],
        dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
        dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        weekHeader: "Tuần",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "",
    };
    $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
});
