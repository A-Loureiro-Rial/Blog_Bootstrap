<?php
    require(PATH . 'functions/Edit.php');
    function EditButton($article)
    {
        $CatList = Category::ExportAll();
    ?>
                        <button type="button" class="btn btn-primary h-100 my-2" data-toggle="modal" data-target="#exampleModal3">
                            Edit
                        </button>
                        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title text-center">Create your very own article!</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="d-flex flex-column justify-content-center" action="<?=HTMLPATH . 'Views/Modified.php'?>" method="post">
                                            <span class="text-info font-weight-bold text-center">Title</span>
                                            <div class="form-group row d-flex justify-content-center">
                                                <input class="form-control form-control-lg m-2 w-75" name="Title" type="text" placeholder="Type your title here!" value="<?=$article->Title?>">
                                            </div>
                                            <span class="text-info font-weight-bold text-center">Author</span>
                                            <div class="form-group row d-flex justify-content-center">
                                                <input class="form-control form-control-sm mx-2 w-75" name="Author" type="text" placeholder="Become famous, write your name here!" value="<?=$article->Author?>">
                                            </div>
                                            <span class="text-info font-weight-bold text-center">Content</span>
                                            <div class="form-group row d-flex justify-content-center">
                                                <textarea class="form-control m-2 w-75" name="Content" id="Content" cols="30" rows="10" placeholder="Type your article here!"><?=$article->Content?></textarea>
                                            </div>
                                            <span class="text-info font-weight-bold text-center">Select your category</span>
                                            <div class="form-group row d-flex flex-wrap justify-content-center m-5">
<?php
        $i = 0;
        foreach ($CatList as $cat)
        {
            $Check = isChecked($article, $cat) ? ' checked' : '';
?>
                                            <div class="custom-control custom-checkbox w-25 d-flex justify-content-center">
                                                <input type="checkbox" class="custom-control-input" name="Cat[]" id="customCheck<?=$i?>" value="<?=$cat->CategoryID?>"<?=$Check?>>
                                                <label class="custom-control-label" for="customCheck<?=$i?>"><?=$cat->CategoryName?></label>
                                            </div>
<?php
            $i++;
        }
?>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="ID" value="<?=$article->ID?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-info" value="Modify my article!">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
    }
?>