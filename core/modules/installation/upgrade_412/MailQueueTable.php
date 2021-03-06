<?php

    namespace thebuggenie\core\modules\installation\upgrade_412;

    use thebuggenie\core\entities\tables\ScopedTable;

    /**
     * @Table(name="mailing_queue")
     */
    class MailQueueTable extends ScopedTable
    {

        const B2DB_TABLE_VERSION = 1;
        const B2DBNAME = 'mailing_queue';
        const ID = 'mailing_queue.id';
        const MESSAGE = 'mailing_queue.headers';
        const DATE = 'mailing_queue.date';
        const SCOPE = 'mailing_queue.scope';

        protected function initialize()
        {
            parent::setup(self::B2DBNAME, self::ID);
            parent::addText(self::MESSAGE);
            parent::addInteger(self::DATE, 10);
        }

    }
