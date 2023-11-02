<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1"
            style="background: url('<?= base_url('assets/images/resource/mslider1.jpg')?>') repeat scroll 50% 422.28px transparent;"
            class="parallax scrolly-invisible no-parallax"></div>
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header" style="padding-top: 90px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dashboardhak">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Products</h2>
                <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Job</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">
    <div class="user-dashboard">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12" style="margin-bottom: 10px;">
                <a href="#" class="btn btn-primary Education_Btn">Add</a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak">
                    <table class="table table-bordered Dash-Product">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Desctiption</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Demo</td>
                                <td>Demo</td>
                                <td class="d-flex justify-content-around">
                                    <a href="#" id="View1" data-toggle="tooltip" title="View"><i class="fa fa-eye"
                                            aria-hidden="true"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr id="Product-Data-Block1">
                                <td colspan="4" class="Product-Details-Page">
                                    <div class="row Product-Block">
                                        <div class="col-lg-4 col-md-12 col-sm-12 column Product-Img">
                                            <div class="Product-Img-Container">
                                                <div class="imgSlides">
                                                    <img src="https://cdn.shopify.com/s/files/1/0070/7032/files/trending-products_c8d0d15c-9afc-47e3-9ba2-f7bad0505b9b.png?format=jpg&quality=90&v=1614559651"
                                                        style="width:100%">
                                                </div>
                                                <div class="imgSlides">
                                                    <img src="https://static.doofinder.com/main-files/uploads/2018/01/Top6Sales.png"
                                                        style="width:100%">
                                                </div>
                                                <div class="imgSlides">
                                                    <img src="https://queue-it.com/media/ppcp1twv/product-drop.jpg"
                                                        style="width:100%">
                                                </div>
                                                <div class="imgSlides">
                                                    <img src="https://cdn.shopify.com/s/files/1/0070/7032/files/trending-products_c8d0d15c-9afc-47e3-9ba2-f7bad0505b9b.png?format=jpg&quality=90&v=1614559651"
                                                        style="width:100%">
                                                </div>
                                                <div class="imgSlides">
                                                    <img src="https://static.doofinder.com/main-files/uploads/2018/01/Top6Sales.png"
                                                        style="width:100%">
                                                </div>
                                                <div class="imgSlides">
                                                    <img src="https://queue-it.com/media/ppcp1twv/product-drop.jpg"
                                                        style="width:100%">
                                                </div>
                                                <a class="prev" onclick="plusSlides(-1)">❮</a>
                                                <a class="next" onclick="plusSlides(1)">❯</a>
                                                <div class="row Slider-All-Img">
                                                    <div class="column">
                                                        <img class="demo cursor"
                                                            src="https://cdn.shopify.com/s/files/1/0070/7032/files/trending-products_c8d0d15c-9afc-47e3-9ba2-f7bad0505b9b.png?format=jpg&quality=90&v=1614559651"
                                                            style="width:100%" onclick="currentSlide(1)"
                                                            alt="The Woods">
                                                    </div>
                                                    <div class="column">
                                                        <img class="demo cursor"
                                                            src="https://static.doofinder.com/main-files/uploads/2018/01/Top6Sales.png"
                                                            style="width:100%" onclick="currentSlide(2)"
                                                            alt="Cinque Terre">
                                                    </div>
                                                    <div class="column">
                                                        <img class="demo cursor"
                                                            src="https://queue-it.com/media/ppcp1twv/product-drop.jpg"
                                                            style="width:100%" onclick="currentSlide(3)"
                                                            alt="Mountains and fjords">
                                                    </div>
                                                    <div class="column">
                                                        <img class="demo cursor"
                                                            src="https://cdn.shopify.com/s/files/1/0070/7032/files/trending-products_c8d0d15c-9afc-47e3-9ba2-f7bad0505b9b.png?format=jpg&quality=90&v=1614559651"
                                                            style="width:100%" onclick="currentSlide(4)"
                                                            alt="The Woods">
                                                    </div>
                                                    <div class="column">
                                                        <img class="demo cursor"
                                                            src="https://static.doofinder.com/main-files/uploads/2018/01/Top6Sales.png"
                                                            style="width:100%" onclick="currentSlide(5)"
                                                            alt="Cinque Terre">
                                                    </div>
                                                    <div class="column">
                                                        <img class="demo cursor"
                                                            src="https://queue-it.com/media/ppcp1twv/product-drop.jpg"
                                                            style="width:100%" onclick="currentSlide(6)"
                                                            alt="Mountains and fjords">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column Product-Data">
                                            <p><span>Test Product</span></p>
                                            <p><span>In publishing and graphic design, Lorem ipsum is a placeholder text
                                                    commonly used to demonstrate.</span></p>
                                        </div>
                                        <div class="col-lg-4 column Product-Contact">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Name</label>
                                                    <label class="data">Arnab Das</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Email</label>
                                                    <label class="data">demo@gmail.com</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Details</label>
                                                    <label class="data data-field">In publishing and graphic design,
                                                        Lorem ipsum is a
                                                        placeholder text commonly used to demonstrate the visual
                                                        form of a document or a typeface without relying on
                                                        meaningful content. Lorem ipsum may be used as a placeholder
                                                        before final copy is available.</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Name</label>
                                                    <label class="data">Arnab Das</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Email</label>
                                                    <label class="data">demo@gmail.com</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label">Details</label>
                                                    <label class="data data-field">In publishing and graphic design,
                                                        Lorem ipsum is a
                                                        placeholder text commonly used to demonstrate the visual
                                                        form of a document or a typeface without relying on
                                                        meaningful content. Lorem ipsum may be used as a placeholder
                                                        before final copy is available.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name" />
                <input type="text" placeholder="Post of Post" name="mail" />
                <input type="text" placeholder="Author" name="passsword" />
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $("#View1").click(function () {
        $("#Product-Data-Block1").toggleClass('Show-Product-Block')
    });
</script>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("imgSlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>
</section>
