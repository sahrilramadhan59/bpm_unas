<div id="cetakpdf" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cetak</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="cetak_upm" method="POST" target="_blank">
                    <table>
                        <tr>
                            <td>
                                <div class="form-group">Dari Tanggal</div>
                            </td>
                            <td align="center" width="5%">
                                <div class="form-group">:</div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" name="tgl_awal" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">Sampai Tanggal</div>
                            </td>
                            <td align="center" width="5%">
                                <div class="form-group">:</div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" name="tgl_akhir" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <button name="cetak" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> CETAK PDF</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>