# Tinyquote

## 安装

```bash
composer require hzmwdz/tinyquote
```

## 发布配置

```bash
php artisan vendor:publish --tag="tinyquote-config"
```

## 发布语言

```bash
php artisan vendor:publish --tag="tinyquote-translations"
```

## 发布迁移

```bash
php artisan vendor:publish --tag="tinyquote-migrations"
```

## 导入报价

```bash
php artisan vendor:publish --tag="tinyquote-imports"

php artisan import:quote pcb
php artisan import:quote assembly
php artisan import:quote stencil
```

## 使用示例

```php
use Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO;
use Hzmwdz\Tinyquote\Quoters\PcbQuoter;
use Hzmwdz\Tinyquote\Validators\PcbQuoteValidator;

class Example
{
    /**
     * @var \Hzmwdz\Tinyquote\Quoters\PcbQuoter
     */
    protected $quoter;

    /**
     * @param \Hzmwdz\Tinyquote\Quoters\PcbQuoter $quoter
     */
    public function __construct(PcbQuoter $quoter)
    {
        $this->quoter = $quoter;
    }

    /**
     * @param array $data
     * @return \Hzmwdz\Tinyquote\Quotations\PcbQuotation
     */
    public function execute($data)
    {
        $validated = PcbQuoteValidator::validate($data);

        $quoteDTO = PcbQuoteDTO::fromArray($validated);

        $quotation = $this->quoter->quote($quoteDTO);

        return $quotation;
    }
}
```
