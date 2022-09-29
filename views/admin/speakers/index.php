<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__button-container ">
    <a href="/admin/speakers/create" class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
        Add Speaker
    </a>
</div>

<div class="dashboard__container">
    <?php if(!empty($speakers)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Name</th>
                    <th scope="col" class="table__th">Location</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($speakers as $speaker) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $speaker->name . " " . $speaker->last_name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $speaker->city . ", " . $speaker->country; ?>
                        </td>
                        <td class="table__td--actions">
                            <a href="/admin/speakers/update?id=<?php echo $speaker->id; ?>" class="table__action table__action--update">
                                <i class="fa-solid fa-user-pen"></i>
                                Update
                            </a>

                            <form method="POST" action="/admin/speakers/delete" class="table__form">
                                <input type="hidden" name="id" value="<?php echo $speaker->id; ?>">
                                <button type="submit" class="table__action table__action--delete">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">There are no speakers yet</p>
    <?php } ?>
</div>

<?php
    echo $pagination;
?>