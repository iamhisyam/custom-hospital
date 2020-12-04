import React, { Fragment, useState } from 'react';
import {
    Button,
    Confirm,
    useUpdateMany,
    useRefresh,
    useNotify,
    useUnselectAll,
} from 'react-admin';
import ClearIcon from '@material-ui/icons/Clear';

const RejectBulkButton = ({ selectedIds, resource }) => {
    const [open, setOpen] = useState(false);
    const refresh = useRefresh();
    const notify = useNotify();
    const unselectAll = useUnselectAll();
    const [updateMany, { loading }] = useUpdateMany(
        'leaves_trans/approval',
        selectedIds,
        { approval_status_code : 2, is_approved:false },
        {
            onSuccess: () => {
                refresh();
                notify('Leaves updated');
                unselectAll(resource);
            },
            onFailure: error => notify('Error: posts not updated', 'warning'),
        }
    );
    const handleClick = () => setOpen(true);
    const handleDialogClose = () => setOpen(false);

    const handleConfirm = () => {
        updateMany();
        setOpen(false);
    };

    return (
        <Fragment>
            <Button label="Reject" onClick={handleClick}>
                <ClearIcon />
            </Button>
            <Confirm
                isOpen={open}
                loading={loading}
                title="Approval Leaves"
                content="Are you sure you want to reject for these leaves request?"
                onConfirm={handleConfirm}
                onClose={handleDialogClose}
            />
        </Fragment>
    );
};

export default RejectBulkButton;