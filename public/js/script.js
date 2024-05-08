// Owl Carousel
$(document).ready(function () {
    var owl1 = $("#owl-produk-diskon");
    var owl2 = $("#owl-produk-populer");
    var owl3 = $("#owl-cari-brand");
    var owl4 = $("#owl-pencarian");

    $("#owl-banner").owlCarousel({
        stagePadding: 50,
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
        },
        onInitialized: function (event) {
            // Add class to set left padding to 0 on initialization
            $(event.target)
                .closest(".owl-stage-outer")
                .addClass("stage-padding-0");
        },
        onResized: function (event) {
            // Remove stagePadding when slider is resized
            $(event.target)
                .closest(".owl-stage-outer")
                .toggleClass(
                    "stage-padding-0",
                    event.item.count <= event.page.size
                );
        },
    });

    $("#owl-kebutuhan").owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        },
    });

    $("#owl-kategori").owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 4,
            },
            600: {
                items: 4,
            },
            1000: {
                items: 6,
            },
        },
    });

    $("#owl-produk-diskon").owlCarousel({
        stagePadding: 50,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 5,
            },
        },
    });

    $("#owl-image-produk").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 4,
            },
        },
    });

    $("#owl-image-produk-mobile").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        items: 1,
        stagePadding: 50,
        onInitialized: handleCarouselInit,
    });

    function handleCarouselInit(event) {
        var stageElement = event.target.querySelector(".owl-stage");
        stageElement.style.paddingRight = "0px";
        stageElement.style.paddingRight = "0px !important";
    }

    // Custom navigation buttons
    $(".custom-navigation-1 .owl-next").click(function () {
        owl1.trigger("next.owl.carousel");
    });
    $(".custom-navigation-1 .owl-prev").click(function () {
        owl1.trigger("prev.owl.carousel");
    });

    $("#owl-produk-populer").owlCarousel({
        stagePadding: 50,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 5,
            },
        },
    });
    // Custom navigation buttons
    $(".custom-navigation-2 .owl-next").click(function () {
        owl2.trigger("next.owl.carousel");
    });

    $(".custom-navigation-2 .owl-prev").click(function () {
        owl2.trigger("prev.owl.carousel");
    });

    $("#owl-cari-brand").owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 4,
            },
            1000: {
                items: 8,
            },
        },
    });
    // Custom navigation buttons
    $(".custom-navigation-3 .owl-next").click(function () {
        owl3.trigger("next.owl.carousel");
    });

    $(".custom-navigation-3 .owl-prev").click(function () {
        owl3.trigger("prev.owl.carousel");
    });

    $("#owl-pencarian").owlCarousel({
        stagePadding: 50,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 5,
            },
        },
    });
    // Custom navigation buttons
    $(".custom-navigation-4 .owl-next").click(function () {
        owl4.trigger("next.owl.carousel");
    });

    $(".custom-navigation-4 .owl-prev").click(function () {
        owl4.trigger("prev.owl.carousel");
    });
});

// Start Quantity
$(document).ready(function () {
    $(".btn-number").click(function (e) {
        e.preventDefault();

        const fieldName = $(this).attr("data-field");
        const type = $(this).attr("data-type");
        const input = $("input[name='" + fieldName + "']");
        const currentValue = parseInt(input.val());

        if (!isNaN(currentValue)) {
            if (type === "minus") {
                input.val(
                    currentValue > input.attr("min")
                        ? currentValue - 1
                        : input.attr("min")
                );
            } else if (type === "plus") {
                input.val(
                    currentValue < input.attr("max")
                        ? currentValue + 1
                        : input.attr("max")
                );
            }
        }
    });
});
// End Quantity

// Start Rating Score
function updateRatingScore(ratingID) {
    const stars = document.getElementsByName("star" + ratingID);
    let total = 0;
    let count = 0;

    for (let i = 0; i < stars.length; i++) {
        if (stars[i].checked) {
            total += parseInt(stars[i].value);
            count++;
        }
    }

    const averageScore = count > 0 ? total / count : 0;
    document.getElementById("score" + ratingID).textContent =
        averageScore.toFixed(1);
}

// Event listeners to update rating score whenever a star is clicked
const rating1Inputs = document.getElementsByName("star1");
rating1Inputs.forEach((input) => {
    input.addEventListener("click", () => {
        updateRatingScore("1");
    });
});

const rating2Inputs = document.getElementsByName("star2");
rating2Inputs.forEach((input) => {
    input.addEventListener("click", () => {
        updateRatingScore("2");
    });
});
// End Rating Score

// Start Radio Selected
// $(function () {
//     const radioButtons = document.querySelectorAll(
//         'input[type="radio"][name="radio-overview"]'
//     );

//     const selectedValuePara1 = document.getElementById("selectedValue1");
//     const selectedValuePara2 = document.getElementById("selectedValue2");
//     const selectedPrice = document.getElementById("selectedPrice");
//     const selectedDiscount = document.getElementById("selectedDiscount");
//     const selectedDiscountPercent = document.getElementById(
//         "selectedDiscountPercent"
//     );
//     const selectedImage = document.getElementById("selectedImage");
//     const selectedMainImage = document.getElementById("image-header");

//     radioButtons.forEach((radioButton) => {
//         radioButton.addEventListener("change", () => {
//             if (radioButton.checked) {
//                 const labelText =
//                     radioButton.nextElementSibling.querySelector(
//                         "h6"
//                     ).textContent;
//                 const labelPrice =
//                     radioButton.nextElementSibling.querySelector(
//                         "h3"
//                     ).textContent;
//                 const labelDiscount =
//                     radioButton.nextElementSibling.querySelector(
//                         "h2"
//                     ).textContent;
//                 const labelDiscountPercentage =
//                     radioButton.nextElementSibling.querySelector(
//                         "h1"
//                     ).textContent;
//                 const imageURL = radioButton.nextElementSibling
//                     .querySelector("img")
//                     .getAttribute("src");

//                 const labelSelectedPriceCalculate =
//                     radioButton.nextElementSibling.querySelector(
//                         "h4"
//                     ).textContent;
//                 const labelSelectedStockCalculate =
//                     radioButton.nextElementSibling.querySelector(
//                         "h5"
//                     ).textContent;

//                 selectedValuePara1.textContent = labelText;
//                 selectedValuePara2.textContent = labelText;
//                 const priceValue = labelPrice.match(/\d+(\.\d+)?/)[0];
//                 if (priceValue != 0) {
//                     selectedPrice.textContent = labelPrice;
//                 } else {
//                     selectedPrice.textContent = labelDiscount;
//                 }
//                 const discountValue = labelDiscount.match(/\d+(\.\d+)?/)[0];
//                 if (discountValue != priceValue) {
//                     selectedDiscount.textContent = labelDiscount;
//                 }
//                 selectedDiscountPercent.textContent = labelDiscountPercentage;

//                 if (
//                     labelDiscount != labelPrice &&
//                     labelDiscountPercentage != 100
//                 ) {
//                     selectedDiscountPercent.style.display = "block";
//                 } else {
//                     selectedDiscountPercent.style.display = "none";
//                 }

//                 selectedImage.setAttribute("src", imageURL);
//                 // selectedMainImage.setAttribute('src', imageURL);

//                 document.addEventListener("livewire:init", () => {
//                     Livewire.on("getProductUnit", (event) => {
//                         Livewire.dispatch("getProductUnit", {
//                             data: {
//                                 priceCalculate: labelSelectedPriceCalculate,
//                                 stockCalculate: labelSelectedStockCalculate,
//                             },
//                         });
//                     });
//                 });
//             } else {
//                 selectedValuePara1.textContent = "-";
//                 selectedValuePara2.textContent = "-";
//                 selectedImage.removeAttribute("src");
//             }
//         });
//     });
// });
// End Radio Selected

// Start Select Images
// const owlImageProduk = document.getElementById('owl-image-produk');
// const imageHeader = document.getElementById('image-header');

// owlImageProduk.addEventListener('click', event => {
//     const target = event.target;
//     if (target.tagName === 'IMG') {
//         const imageURL = target.getAttribute('src');
//         imageHeader.setAttribute('src', imageURL);
//     }
// });
// End Select Images
