<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__button-container ">
    <a href="/admin/events/create" class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
        Add Event
    </a>
</div>

<div class="dashboard__container">
    <?php if(!empty($events)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Event</th>
                    <th scope="col" class="table__th">Category</th>
                    <th scope="col" class="table__th">Date and Time</th>
                    <th scope="col" class="table__th">Speaker</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($events as $event) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $event->name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->category->name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->day->name . ", " . $event->hour->hour; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->speaker->name . " " . $event->speaker->last_name; ?>
                        </td>
                        <td class="table__td--actions">
                            <a href="/admin/events/update?id=<?php echo $event->id; ?>" class="table__action table__action--update">
                                <i class="fa-solid fa-pencil"></i>
                                Update
                            </a>

                            <form method="POST" action="/admin/events/delete" class="table__form">
                                <input type="hidden" name="id" value="<?php echo $event->id; ?>">
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
        <p class="text-center">There are no events yet</p>
    <?php } ?>
</div>

<?php
    echo $pagination;
?>