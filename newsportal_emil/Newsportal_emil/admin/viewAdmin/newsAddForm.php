<?php

ob_start();

?>

<div class="container" style="min-height:400px;">

    <div class="col-md-11">

        <h2>Lisa uudis</h2>

        <?php

        if (isset($test)) {

            if ($test === true) {

                echo '
                    <div class="alert alert-info">
                        <strong>Uudis on lisatud.</strong>
                        <a href="newsAdmin">
                            Uudiste nimekiri
                        </a>
                    </div>
                ';

            } else {

                echo '
                    <div class="alert alert-warning">
                        <strong>Uudise lisamine ebaõnnestus.</strong>
                    </div>
                ';
            }
        }

        ?>

        <form
            method="POST"
            action="newsAddResult"
            enctype="multipart/form-data"
        >

            <table class="table table-bordered">

                <tr>

                    <td>Pealkiri</td>

                    <td>
                        <input
                            type="text"
                            name="title"
                            maxlength="255"
                            class="form-control"
                            required
                        >
                    </td>

                </tr>


                <tr>

                    <td>Uudise tekst</td>

                    <td>
                        <textarea
                            name="text"
                            rows="5"
                            class="form-control"
                            required
                        ></textarea>
                    </td>

                </tr>


                <tr>

                    <td>Kategooria</td>

                    <td>

                        <select
                            name="idCategory"
                            class="form-control"
                            required
                        >

                            <?php

                            foreach ($arr as $row) {

                                echo '<option value="' .
                                    $row['id'] .
                                    '">' .
                                    htmlspecialchars($row['name']) .
                                    '</option>';
                            }

                            ?>

                        </select>

                    </td>

                </tr>


                <tr>

                    <td>Pilt</td>

                    <td>
                        <input
                            type="file"
                            name="picture"
                            accept="image/jpeg,image/png,image/gif,image/webp"
                            required
                        >
                    </td>

                </tr>


                <tr>

                    <td colspan="2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                            name="save"
                        >
                            Lisa uudis
                        </button>

                        <a
                            href="newsAdmin"
                            class="btn btn-success"
                        >
                            Tagasi
                        </a>

                    </td>

                </tr>

            </table>

        </form>

    </div>

</div>

<?php

$content = ob_get_clean();

include 'viewAdmin/templates/layout.php';

?>