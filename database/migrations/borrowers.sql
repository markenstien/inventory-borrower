drop table if exists borrowers;
create table borrowers(
    id int(10) not null primary key auto_increment,
    reference varchar(50),
    beneficiary_id int(10),
    staff_id int(10),
    item_id int(10),
    borrow_date date,
    borrow_time time,
    borrow_state enum('good','broken'),
    borrow_remark text,
    return_on_date date,

    return_date date,
    return_time time,
    return_state enum('good','broken'),
    return_remark text,

    created_at timestamp default now(),
    status enum('pending','on-going','returned','cancelled')
);