<?php

namespace App\Admin\Actions\Grid;

use App\Logic\UserLogic;
use App\Models\UserTi;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TxJj extends RowAction
{
    /**
     * @return string
     */
	protected $title = '同意';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $detail = UserTi::findOrFail($this->getKey());
        if ($detail->status != 1) {
            return $this->response()->error('该提现已处理');
        }
        DB::beginTransaction();
        try {
            $detail->status = 3;
            $detail->save();
            $ress = UserLogic::userPrice($detail->user_id, $detail->price, 1, '提现被拒绝', '提现被拒绝','');
            DB::commit();
            return $this->response()->success('提现已拒绝');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response()->error('操作失败');
        }
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		// return ['Confirm?', 'contents'];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
