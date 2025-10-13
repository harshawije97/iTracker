<?php

enum ItemStatus: string
{
    case IN_STOCK = 'in stock';
    case ON_REPAIR = 'on repair';
}

enum Role: string
{
    case IT_MANAGER = 'it-manager';
    case ASSISTANT_IT_MANAGER = 'assistant-it-manager';
    case CHIEF_CLERK = 'chief-clerk';
    case ESTATE_MANAGER = 'estate-manager';
    case IT_ADMIN = 'it-admin';
}

enum IncidentPriority: string
{
    case LOW = 'low';
    case MODERATE = 'moderate';
    case HIGH = 'high';
}
