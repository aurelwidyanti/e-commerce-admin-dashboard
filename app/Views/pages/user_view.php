<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
Add Data
</button>
<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Username</th>
	<th scope="col">Role</th>
	<th scope="col">Status</th> 
	<th scope="col"></th> 
	</tr>
</thead>
<tbody>
	<?php foreach($users as $index=>$user): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
	<td><?php echo $user['username'] ?></td> 
	<td><?php echo $user['role'] ?></td> 
	<td>
	<form action="<?= base_url('user/edit/'.$user['id']) ?>" method="post">
        <?php
        if($user['is_active']==true){
            echo form_hidden('id',$user['id']);
            echo form_hidden('is_active',0);
			echo form_hidden('editRole',0);
            ?>
        <button type="submit" class="btn btn-success" >
            Active
        </button>
        <?php
        } else {
            echo form_hidden('id',$user['id']);
            echo form_hidden('is_active',1);
			echo form_hidden('editRole',0);
        ?>
        <button type="submit" class="btn btn-warning" >
            Inactive
        </button>
        <?php
        }
        ?>
        </form>

	</td>

	<td>
		<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['id'] ?>">
			Edit
		</button>
		<a href="<?= base_url('user/delete/'.$user['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
			Delete
		</a>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('user/edit/'.$user['id']) ?>" method="post">
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Username</label>
					<input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" required>
				</div>
				
				<?php echo form_hidden('editRole',1) ?>
				<label for="role">Role</label>
				<select name="role" class="form-select" aria-label="role">
                    <option <?php if($user['role']=='admin'){echo "selected";}else{ echo "";} ?> value="admin">Admin</option>
                    <option <?php if($user['role']=='user'){echo "selected";}else{ echo "";} ?> value="user">User</option>
                </select>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- End Table with stripped rows -->
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Add Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form action="<?= base_url('user') ?>" method="post" enctype="multipart/form-data">
		<?= csrf_field(); ?>
		<div class="modal-body">
			<div class="form-group">
				<label for="name">Username</label>
				<input type="text" name="username" class="form-control" id="username" placeholder="@" required>
			</div>
			<div class="form-group">
				<label for="name">Role</label>
				<input type="text" name="role" class="form-control" id="role" required>
			</div>
			<div class="form-group">
				<label for="name">Status</label>
				<input type="text" name="is_active" class="form-control" id="is_active" required>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
		</form>
		</div>
	</div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>