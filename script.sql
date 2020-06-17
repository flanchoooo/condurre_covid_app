create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(191) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_resets
(
    email      varchar(191) not null,
    token      varchar(191) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table role_permissions
(
    id                      int auto_increment
        primary key,
    transaction_manager     varchar(2)                          null,
    dashboard               varchar(2)                          null,
    devices                 varchar(2)                          null,
    card_production         varchar(2)                          null,
    merchants               varchar(2)                          null,
    role_name               varchar(64)                         null,
    reports                 varchar(2)                          null,
    card_initiation         varchar(2)                          null,
    card_auth               varchar(2)                          null,
    change_status           varchar(2)                          null,
    merchant_profile        varchar(2)                          null,
    merchant_acc_management varchar(2)                          null,
    pos_devices             varchar(2)                          null,
    create_merchant         varchar(2)                          null,
    edit_merchant           varchar(2)                          null,
    add_account             varchar(2)                          null,
    add_pos                 varchar(2)                          null,
    update_merchant_acc     varchar(2)                          null,
    update_pos_devices      varchar(2)                          null,
    delete_pos_devices      varchar(2)                          null,
    users                   varchar(2)                          null,
    e_value_checker         varchar(2)                          null,
    updated_at              timestamp default CURRENT_TIMESTAMP null,
    created_at              timestamp default CURRENT_TIMESTAMP null,
    created_by              varchar(64)                         null,
    updated_by              varchar(64)                         null,
    delete_card             varchar(2)                          null,
    acc                     varchar(2)                          null,
    status                  varchar(16)                         null,
    version                 int                                 null,
    account_management      varchar(2)                          null,
    wallet_services         varchar(2)                          null,
    update_wallet           varchar(2)                          null,
    wallet_pin              varchar(2)                          null,
    update_merchant_pos     varchar(2)                          null,
    ib_dashboard            varchar(2)                          null,
    ib_transactions         varchar(2)                          null,
    ib_change_status        varchar(2)                          null,
    rtgs                    varchar(2)                          null,
    corporate               varchar(2)                          null,
    wallet_configs          varchar(2)                          null,
    loans_approve           varchar(2)                          null,
    loans_authorize         varchar(2)                          null,
    loans                   varchar(2)                          null,
    loans_profile           varchar(2)                          null,
    loan_configurations     varchar(2)                          null
);

create table users
(
    id                  int unsigned auto_increment
        primary key,
    name                varchar(191) not null,
    email               varchar(191) not null,
    password            varchar(191) not null,
    mobile              varchar(191) null,
    digits              varchar(191) null,
    account_number      varchar(191) null,
    type                varchar(191) null,
    status              varchar(191) null,
    remember_token      varchar(100) null,
    created_at          timestamp    null,
    updated_at          timestamp    null,
    username            varchar(191) null,
    role_permissions_id int          null,
    external_reference  int          null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;


