<?php
declare(strict_types=1);

namespace Ekvio\Integration\Invoker\Report;

/**
 * Class ReportErrorsHeader
 * @package App
 */
class ReportError
{
    private const UNKNOWN_ERROR = 'UNKWN_ERR';
    private $errorMap = [
        'login_login_required' => 'LOGIN_NVALID',
        'login_значение_логин_неверно' => 'LOGIN_NVALID',
        'email_value_is_not_unique' => 'EMAIL_NUNIQ',
        'phone_value_is_not_unique' => 'PHONE_NUNIQ',
        'email_e_mail_is_not_a_valid_email_address' => 'EMAIL_NVALID',
        'chief_email_manager_s_e_mail_is_not_a_valid_email_address' => 'CHIEF_EMAIL_NVALID',
        'phone_incorrect_phone' => 'PHONE_NVALID',
        'tabnumber_tabnumber_is_empty' => 'TABNUMBER_EMPT',
        'region_group_is_empty' => 'HOLDING_EMPT',
        'city_group_is_empty' => 'BE_EMPT',
        'role_group_is_empty' => 'DIVISION_EMPT',
        'position_group_is_empty' => 'TERRITORY_EMPT',
        'team_group_is_empty' => 'TEAM_EMPT',
        'assignment_group_is_empty' => 'POSITION_EMPT',
        'first_name_cannot_be_blank' => 'FIRST_NAME_EMPT',
        'last_name_cannot_be_blank' => 'LAST_NAME_EMPT',
        'first_name_incorrect_data_format_please_try_again' => 'FIRST_NAME_NVALID',
        'last_name_incorrect_data_format_please_try_again' => 'LAST_NAME_NVALID'
    ];

    /**
     * ReportErrorsHeader constructor.
     * @param array $errorMap
     */
    public function __construct(array $errorMap = [])
    {
        if($errorMap) {
            $this->errorMap = array_merge($this->errorMap, $errorMap);
        }
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        $this->errorMap[] = self::UNKNOWN_ERROR;
        return array_unique(array_values($this->errorMap));
    }

    /**
     * @param string $field
     * @param string $message
     * @return string
     */
    public function getError(string $field, string $message): string
    {
        $replacedMsg = trim(preg_replace("([ '.,\"\-«»]+)", '_', $message), '_');

        $key = sprintf('%s_%s',
            mb_strtolower($field),
            mb_strtolower($replacedMsg)
        );

        return $this->errorMap[$key] ?? self::UNKNOWN_ERROR;
    }
}