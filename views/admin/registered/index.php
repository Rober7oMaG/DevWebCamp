<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container">
    <?php if(!empty($registrations)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Name</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Bundle</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($registrations as $registration) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $registration->user->name . " " . $registration->user->last_name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $registration->user->email ?>
                        </td>
                        <td class="table__td">
                            <?php echo $registration->bundle->name ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">There are no registrations yet</p>
    <?php } ?>
</div>

<?php
    echo $pagination;
?>