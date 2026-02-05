<?php

namespace App\Domain\AppointmentRequest;

use App\Models\Appointment;
use Carbon\Carbon;
use DomainException;

class AppointmentRequest
{
    private ?int $id = null;
    private ?int $clientId = null;
    private ?string $requestDate = null;
    private ?string $requestTime = null;
    private ?string $status = null;
    private ?string $reason = null;

    public const STATUS_UNDER_ANALYSIS = 'UNDER_ANALYSIS';
    public const STATUS_CANCELED = 'CANCELED';
    public const STATUS_REJECTED = 'REJECTED';
    public const STATUS_ACCEPTED = 'ACCEPTED';
    public const STATUS_EXPIRED = 'EXPIRED';

    public function __construct(){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function getRequestDate(): ?string
    {
        return $this->requestDate;
    }

    public function getRequestTime(): ?string
    {
        return $this->requestTime;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }


    public static function createNewAppointmentRequest (
        int $clientId,
        string $requestDate,
        string $requestTime,
        ?string $reason
    ): self
    {
        $requestDate = Carbon::parse($requestDate);
        if ($requestDate < Carbon::now()) {
            throw new DomainException('Request date cannot be in the past');
        }
        $order = new self();
        $order->clientId = $clientId;
        $order->requestDate = $requestDate;
        $order->requestTime = $requestTime;
        $order->status = self::STATUS_UNDER_ANALYSIS;
        $order->reason = $reason;
        return $order;
    }

    public function accept(): self
    {
        if ($this->status !== self::STATUS_UNDER_ANALYSIS) {
            throw new DomainException('Request is not under analysis');
        }
        $this->status = self::STATUS_ACCEPTED;
        return $this;
    }

    public function reject(): self
    {
        if ($this->status !== self::STATUS_UNDER_ANALYSIS) {
            throw new DomainException('Request is not under analysis');
        }
        $this->status = self::STATUS_REJECTED;
        return $this;
    }

    public function cancel(): self
    {
        if ($this->status !== self::STATUS_UNDER_ANALYSIS) {
            throw new DomainException('Request is not under analysis');
        }
        $this->status = self::STATUS_CANCELED;
        return $this;
    }



}