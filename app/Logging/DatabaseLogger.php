<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use App\Models\Log as LogModel; // Asegúrate de tener un modelo de Log
use Monolog\LogRecord;

class DatabaseLogger extends AbstractProcessingHandler
{
    /**
     * DatabaseLogger constructor.
     *
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * Escribe el registro en la base de datos.
     *
     * @param array $record
     */
    protected function write(LogRecord $record)
    {
        // Guardar el log en la base de datos
        LogModel::create([
            'level' => $record['level_name'], // Nivel del log (ej. 'INFO', 'ERROR', etc.)
            'message' => $record['message'],  // Mensaje del log
            'context' => json_encode($record['context']), // Datos adicionales del log
        ]);
    }
}
