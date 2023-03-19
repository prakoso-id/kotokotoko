<style type="text/css">
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .done {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 25%;
        float: left;
        position: relative
    }

    #progressbar #timeline_bayar:before {
        font-family: FontAwesome;
        content: "\f09d"
    }

    #progressbar #timeline_proses:before {
        font-family: FontAwesome;
        content: "\f046"
    }

    #progressbar #timeline_kirim:before {
        font-family: FontAwesome;
        content: "\f0d1"
    }

    #progressbar #timeline_selesai:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.done:before,
    #progressbar li.done:after {
        background: #32c670
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #2268c9
    }

    #progressbar li.batal:before,
    #progressbar li.batal:after {
        background: #e74c3c
    }
</style>
<div class="container-fluid" id="grad1" style="margin-bottom: 10px;">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="timeline_bayar">
                                    <strong>Pembayaran</strong>
                                    <br><span class="timeline-tgl"></span>
                                </li>
                                <li id="timeline_proses">
                                    <strong>Diproses</strong>
                                    <br><span class="timeline-tgl"></span>
                                </li>
                                <li id="timeline_kirim">
                                    <strong>Pengiriman</strong>
                                    <br><span class="timeline-tgl"></span>
                                </li>
                                <li id="timeline_selesai">
                                    <strong>Sampai & Selesai</strong>
                                    <br><span class="timeline-tgl"></span>
                                </li>
                            </ul> <!-- fieldsets -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>